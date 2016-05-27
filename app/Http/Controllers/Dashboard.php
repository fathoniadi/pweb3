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
use App\postComment;
use App\group;

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
            Session::put('user',base64_encode(Cookie::get('user')));
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
        //Session::put('user',$this->userLogin);
        $flagUserLocations = DB::SELECT("SELECT user_location from userDetail where username = '".$this->userLogin."'");
        foreach ($flagUserLocations as $flagUserLocation) {
            $this->userLoginLocation = $flagUserLocation->user_location;
        }
	}

    public function commentajax()
    {
        $data['comments'] = DB::SELECT("SELECT * FROM userDetail, postComment where userDetail.username = postComment.comment_user and postComment.comment_post=".Input::get('id')."");
        return view('dashboard/commentajax',$data);
    }

    public function timeline()
    {
        $data['posts'] = DB::select("select * from userDetail, postEvent where userDetail.username = postEvent.post_owner and postEvent.post_location = ".$this->userLoginLocation." order by postEvent.post_id desc LIMIT 1");
        $data['userLoginLikeds'] = postLike::where('like_user',$this->userLogin)->get();
        $data['userLoginJoineds'] = postJoin::where('join_user',$this->userLogin)->get();
        $data['userInfos'] = DB::select("SELECT * from userDetail, userAccount where userDetail.username = userAccount.username and userAccount.username = '".$this->userLogin."'");
        $data['userPosts'] = postEvent::where('post_owner',$this->userLogin)->get();
        $data['userJoinedPosts'] = DB::SELECT("SELECT * from postEvent, postJoin where postEvent.post_id = postJoin.join_post and postJoin.join_user = '".$this->userLogin."' and postJoin.join_flag=0");
        $data['jumlahLikePosts'] = DB::SELECT("select like_post,count(like_id) as jumlahLikePost from postLike group by like_post");
        $data['jumlahJoinPosts'] = DB::SELECT("select join_post, count(join_id) as jumlahJoinPost from postJoin group by join_post");
        $data['comments'] = DB::SELECT("SELECT * FROM userDetail, postComment where userDetail.username = postComment.comment_user");
        $data['groups'] = Group::get();
    	return view('dashboard/timeline',$data);
    }

    public function deletecomment()
    {
        $flagDeleteComment = postComment::where('comment_id',Input::get('comment_id'))->delete();
    }

    public function timelineorder()
    {
        $timelineOrder = Input::get('flagOrder');
        if($timelineOrder==1)
        {
            $data['posts'] = DB::select("select * from userDetail, postEvent where userDetail.username = postEvent.post_owner and postEvent.post_location = ".$this->userLoginLocation." order by postEvent.post_id desc LIMIT ".Input::get("counter")."");
        }
        elseif($timelineOrder==2)
        {
            $data['posts'] = DB::select("select * 
                from userDetail, 
                (select postEvent.*,count(like_id) as jumlahLike
                from postEvent left join postLike 
                on postEvent.post_id = postLike.like_post 
                group by postEvent.post_id) asd where userDetail.username = asd.post_owner and asd.post_location = ".$this->userLoginLocation." order by asd.jumlahLike desc LIMIT ".Input::get("counter")."");
        }
        else
        {
            $data['posts'] = DB::select("select * 
                from userDetail, 
                (select postEvent.*,count(join_id) as jumlahJoin
                from postEvent left join postJoin 
                on postEvent.post_id = postJoin.join_post 
                group by postEvent.post_id) asd where userDetail.username = asd.post_owner and asd.post_location = ".$this->userLoginLocation." order by asd.jumlahJoin desc LIMIT ".Input::get("counter")."");
        }

        $flagPost = new postEvent;
        $counterFlag = $flagPost->get();

        if($counterFlag->count()>=Input::get("counter"))
        {

            $data['userLoginLikeds'] = postLike::where('like_user',$this->userLogin)->get();
            $data['userLoginJoineds'] = postJoin::where('join_user',$this->userLogin)->get();
            $data['userInfos'] = DB::select("SELECT * from userDetail, userAccount where userDetail.username = userAccount.username and userAccount.username = '".$this->userLogin."'");
            $data['jumlahLikePosts'] = DB::SELECT("select like_post,count(like_id) as jumlahLikePost from postLike group by like_post");
            $data['jumlahJoinPosts'] = DB::SELECT("select join_post, count(join_id) as jumlahJoinPost from postJoin group by join_post");
            $data['comments'] = DB::SELECT("SELECT * FROM userDetail, postComment where userDetail.username = postComment.comment_user");
            return view('dashboard/timelineajax',$data);
        }
        else echo '-1';
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
            /*'lokasi_event' => 'required|numeric',*/
            'gambar_event' => 'image'
            );
            $flagGambar = 1;
        }
        else
        {
            $rulesPostEvent = array(
            'nama_event' => 'required',
            'deskripsi_event' => 'required',
            'waktu_event' => 'required'
           /* 'lokasi_event' => 'required|numeric'*/
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
            /*$lokasi_event = Input::get('lokasi_event');*/
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
           // echo "2016-09-12T01:00";

            
            $rowsDateEvent = DB::select("SELECT timestamp('".$waktu_event."','RRRR-MM-DD HH24:MI') as time");
            foreach ($rowsDateEvent as $rowDateEvent) {
                $waktu_event = $rowDateEvent->time;
            }

            $modelPostEvent = new postEvent;
            $modelPostEvent->post_text = $deskripsi_event;
            if($flagGambar) $modelPostEvent->post_photo = $fotoEvent;
            $modelPostEvent->post_owner = $this->userLogin;
            $modelPostEvent->post_location = $this->userLoginLocation;
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
        $countJumlahLikes = DB::SELECT("select like_post,count(like_id) as jumlahLikePost from postLike where like_post=".Input::get('id')." group by like_post");
        foreach ($countJumlahLikes as $countJumlahLike) 
        {
            echo $countJumlahLike->jumlahLikePost;
        }
    }

    public function doUnLike()
    {
        $flagUnLike = DB::table('postLike')->where('like_user',$this->userLogin)
                                           ->where('like_post',Input::get('id'))
                                           ->delete();
        $countJumlahLikes = DB::SELECT("select like_post,count(like_id) as jumlahLikePost from postLike where like_post=".Input::get('id')." group by like_post");
        if($countJumlahLikes)
        {
            foreach ($countJumlahLikes as $countJumlahLike) 
            {
                echo $countJumlahLike->jumlahLikePost;
            }
        }
        else echo "0";
    }

    public function doJoin()
    {
        $modelPostJoin = new postJoin;
        $modelPostJoin->join_post = Input::get('id');
        $modelPostJoin->join_user = $this->userLogin;
        $modelPostJoin->save();

        $countJumlahJoins = DB::SELECT("select join_post, count(join_id) as jumlahJoinPost from postJoin where join_post=".Input::get('id')." group by join_post");

        foreach ($countJumlahJoins as $countJumlahJoin) {
            echo $countJumlahJoin->jumlahJoinPost;
        }
    }

    public function doUnJoin()
    {
        $flagUnJoin = DB::table('postJoin')->where('join_post',Input::get('id'))
                                            ->where('join_user',$this->userLogin)
                                            ->delete();

        $countJumlahJoins = DB::SELECT("select join_post, count(join_id) as jumlahJoinPost from postJoin where join_post=".Input::get('id')." group by join_post");
        if($countJumlahJoins)
        {
            foreach ($countJumlahJoins as $countJumlahJoin) {
            echo $countJumlahJoin->jumlahJoinPost;
            }
        }
        else echo "0";
    }

    public function addComment()
    {
        $flagWaktuComments = DB::Select("Select sysdate() as date");
        foreach ($flagWaktuComments as $flagWaktuComment) {
           $waktu_comment = $flagWaktuComment->date;
        }
        $modelPostComment = new postComment;
        $modelPostComment->comment_text = Input::get('commentContent');
        $modelPostComment->comment_user = $this->userLogin;
        $modelPostComment->comment_post = Input::get('id');
        $modelPostComment->comment_date = $waktu_comment;

        if($modelPostComment->save()) echo "Sukses";
        else echo "Gagal menambahkan comment";


    }

    public function post($id_post)
    {
        $data['posts'] = DB::select("select * from userDetail, postEvent where postEvent.post_id = ".$id_post." and userDetail.username = postEvent.post_owner");
        //var_dump($data['posts']);
        if($data['posts']){
        $data['userLoginLikeds'] = postLike::where('like_user',$this->userLogin)->get();
        $data['userLoginJoineds'] = postJoin::where('join_user',$this->userLogin)->get();
        $data['userInfos'] = DB::select("SELECT * from userDetail, userAccount where userDetail.username = userAccount.username and userAccount.username = '".$this->userLogin."'");
        $data['userPosts'] = postEvent::where('post_owner',$this->userLogin)->get();
        $data['userJoinedPosts'] = DB::SELECT("SELECT * from postEvent, postJoin where postEvent.post_id = postJoin.join_post and postJoin.join_user = '".$this->userLogin."' and postJoin.join_flag=0");
        $data['jumlahLikePosts'] = DB::SELECT("select like_post,count(like_id) as jumlahLikePost from postLike group by like_post");
        $data['jumlahJoinPosts'] = DB::SELECT("select join_post, count(join_id) as jumlahJoinPost from postJoin group by join_post");
        $data['comments'] = DB::SELECT("SELECT * FROM userDetail, postComment where userDetail.username = postComment.comment_user");
        $data['groups'] = Group::get();
        return view('dashboard/post',$data);
        }
        else return view('errors/404');
    }

    public function editpost($id_post)
    {
        $data['posts'] = DB::select("select * from postEvent where post_id=".$id_post." and post_owner='".$this->userLogin."'");
        //var_dump($data['posts']);
        if($data['posts']){
        $data['userLoginLikeds'] = postLike::where('like_user',$this->userLogin)->get();
        $data['userLoginJoineds'] = postJoin::where('join_user',$this->userLogin)->get();
        $data['userInfos'] = DB::select("SELECT * from userDetail, userAccount where userDetail.username = userAccount.username and userAccount.username = '".$this->userLogin."'");
        $data['userPosts'] = postEvent::where('post_owner',$this->userLogin)->get();
        $data['userJoinedPosts'] = DB::SELECT("SELECT * from postEvent, postJoin where postEvent.post_id = postJoin.join_post and postJoin.join_user = '".$this->userLogin."' and postJoin.join_flag=0");
        return view('dashboard/editpost',$data);
        }
        else return view('errors/404');
    }

    public function deletephotoevent()
    {
        $flagDeletePhoto = DB::UPDATE("UPDATE postEvent set post_photo=NULL where post_id =".Input::get('post_id')." and post_owner = '".$this->userLogin."' ");
        if($flagDeletePhoto) echo "Sukses";
        else echo "Gagal hapus foto";
    }

    public function doupdatepost()
    {
        $flagGambar = 0;
        if(Input::file('gambar_event'))
        {
            $rulesEditPostEvent = array(
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
            $rulesEditPostEvent = array(
            'nama_event' => 'required',
            'deskripsi_event' => 'required',
            'waktu_event' => 'required',
            'lokasi_event' => 'required|numeric'
            );
        }
        
        $validatorEditPost = Validator::make(\Input::all(), $rulesEditPostEvent);

        if($validatorEditPost->fails())
        {
            
            return Redirect::to('post/'.Input::get('post_id'))->withErrors($validatorEditPost);
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
                    return Redirect::to('post/'.Input::get('post_id'))->with("message_fail","Gagal upload foto");
                }
            }
            
            $rowsDateEvent = DB::select("SELECT timestamp('".$waktu_event."','RRRR-MM-DD HH24:MI') as time");
            foreach ($rowsDateEvent as $rowDateEvent) {
                $waktu_event = $rowDateEvent->time;
            }

            /*$modelPostEvent = new postEvent;
            $modelPostEvent->post_text = $deskripsi_event;
            if($flagGambar) $modelPostEvent->post_photo = $fotoEvent;
            $modelPostEvent->post_owner = $this->userLogin;
            $modelPostEvent->post_location = $lokasi_event;
            $modelPostEvent->post_date = $waktu_event;
            $modelPostEvent->post_nameEvent = $nama_event;*/

            if(!$flagGambar) $flagUpdatePost=DB::UPDATE("UPDATE postEvent set  post_text = '".$deskripsi_event."', post_location = ".$lokasi_event.", post_date = '".$waktu_event."', post_nameEvent = '".$nama_event."' where post_id = ".Input::get('post_id')." and post_owner = '".$this->userLogin."' ");
            else $flagUpdatePost=DB::UPDATE("UPDATE postEvent set post_photo = '".$fotoEvent."' ,post_text = '".$deskripsi_event."', post_location = ".$lokasi_event.", post_date = '".$waktu_event."', post_nameEvent = '".$nama_event."' where post_id = ".Input::get('post_id')." and post_owner = '".$this->userLogin."' ");

            if($flagUpdatePost)
            {
                return Redirect::to('post/'.Input::get('post_id'));
            }
            else return Redirect::to('post/'.Input::get('post_id'))->with("message_fail","Gagal post event");

        }
    }

}
