<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Session;
use DB;
use App\Http\Controllers\CheckingSession;
use Cookie;
use Redirect;
use Input;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Html\FormFacade;
use App\postEvent;
use App\userDetail;
use App\postJoin;
use App\postLike;

class Dashboard extends Controller
{
	private $checkingsession;
    private $userLogin;
    private $userLoginLocation;
	public function __construct()
	{
		if(Cookie::get('user')) 
        {
            $user = Cookie::get('user');
        }
        elseif(Session::get('user'))
        {
            $user = base64_decode(Session::get('user'));
        }
        else Redirect::to('login')->send();
        $this->checkingsession = new CheckingSession();
        $flag = $this->checkingsession->Check($user);
        if($flag==0) 
        {
            Redirect::to('login')->send();
        }
        $this->userLogin = base64_decode($user);
        $flagUserLocations = DB::SELECT("SELECT user_location from userDetail where username = '".$this->userLogin."'");
        foreach ($flagUserLocations as $flagUserLocation) {
            $this->userLoginLocation = $flagUserLocation->user_location;
        }
	}

    public function timeline()
    {
        $data['posts'] = DB::select("select * from userDetail, postEvent where userDetail.username = postEvent.post_owner and postEvent.post_location = ".$this->userLoginLocation." order by postEvent.post_id desc LIMIT 1");
        $data['userLoginLikeds'] = postLike::where('like_user',$this->userLogin)->get();
        $data['userLoginJoineds'] = postJoin::where('join_user',$this->userLogin)->get();
        $data['userInfos'] = DB::select("SELECT * from userDetail, userAccount where userDetail.username = userAccount.username and userAccount.username = '".$this->userLogin."'");
    	return view('dashboard/timeline',$data);
    }

    public function timelineajaxmore()
    {
        $data['posts'] = DB::select("select * from userDetail, postEvent where userDetail.username = postEvent.post_owner and postEvent.post_location = ".$this->userLoginLocation."  and postEvent.post_id < ".Input::get('last_id')." order by postEvent.post_id desc  LIMIT 1");
        $data['userLoginLikeds'] = postLike::where('like_user',$this->userLogin)->get();
        $data['userLoginJoineds'] = postJoin::where('join_user',$this->userLogin)->get();
        return view('dashboard/timelineajax',$data);
    }

    public function deletepost()
    {
        $flagDeletePost = DB::table('postEvent')->where('post_id',Input::get('post_id'))->where('post_owner',Input::get('user'))->delete();

        if($flagDeletePost) echo "Sukses";
        else echo "Gagal";
    }

    public function doPostEvent()
    {
        $flagGambar = 0;
        if(Input::file('gambar_event'))
        {
            $rulesPostEvent = array(
            'nama_event' => 'required',
            'deskripsi_event' => 'required',
            'waktu_event' => 'required',
            'lokasi_event' => 'required|numeric',
            'gambar_event' => 'image'
            );
            $flagGambar = 1;
        }
        else
        {
            $rulesPostEvent = array(
            'nama_event' => 'required',
            'deskripsi_event' => 'required',
            'waktu_event' => 'required',
            'lokasi_event' => 'required|numeric'
            );
        }
        
        $validatorPost = Validator::make(\Input::all(), $rulesPostEvent);

        if($validatorPost->fails())
        {
            
            return Redirect::to('timeline')->withErrors($validatorPost);
        }
        else
        {
            $nama_event = Input::get('nama_event');
            $deskripsi_event = Input::get('deskripsi_event');
            $waktu_event = Input::get('waktu_event');
            $lokasi_event = Input::get('lokasi_event');
            $waktu_event = str_replace('T', ' ', $waktu_event);
            
            if($flagGambar) 
            {
                $destFotoEvent = 'public/uploads/photo_event/';
                $extFotoEvent = Input::file('gambar_event')->getClientOriginalExtension();
                $fotoEvent = rand(11111,99999).'_'.$this->userLogin.'.'.$extFotoEvent;
                if(!Input::file('gambar_event')->move($destFotoEvent,$fotoEvent))
                {
                    return Redirect::to('timeline')->with("message_fail","Gagal upload foto");
                }
            }
            echo "2016-09-12T01:00";

            
            $rowsDateEvent = DB::select("SELECT timestamp('".$waktu_event."','RRRR-MM-DD HH24:MI') as time");
            foreach ($rowsDateEvent as $rowDateEvent) {
                $waktu_event = $rowDateEvent->time;
            }

            $modelPostEvent = new postEvent;
            $modelPostEvent->post_text = $deskripsi_event;
            if($flagGambar) $modelPostEvent->post_photo = $fotoEvent;
            $modelPostEvent->post_owner = $this->userLogin;
            $modelPostEvent->post_location = $lokasi_event;
            $modelPostEvent->post_date = $waktu_event;
            $modelPostEvent->post_nameEvent = $nama_event;

            if($modelPostEvent->save())
            {
                return Redirect::to('timeline');
            }
            else return Redirect::to('timeline')->with("message_fail","Gagal post event");

        }
    }

    public function logout(Request $request)
    {
    	$request->session()->flush();
    	return redirect('/')->withCookie(Cookie::forget('user'));
    }

    public function doLike()
    {
        $modelPostLike = new postLike;
        $modelPostLike->like_post = Input::get('id');
        $modelPostLike->like_user = $this->userLogin;
        $modelPostLike->save();
    }

    public function doUnLike()
    {
        $flagUnLike = DB::table('postLike')->where('like_user',$this->userLogin)
                                           ->where('like_post',Input::get('id'))
                                           ->delete();
    }

    public function doJoin()
    {
        $modelPostJoin = new postJoin;
        $modelPostJoin->join_post = Input::get('id');
        $modelPostJoin->join_user = $this->userLogin;

        if($modelPostJoin->save());
    }

    public function doUnJoin()
    {
        $flagUnJoin = DB::table('postJoin')->where('join_post',Input::get('id'))
                                            ->where('join_user',$this->userLogin)
                                            ->delete();
    }

}
