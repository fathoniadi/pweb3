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
use App\groupComment;

class groupcon extends Controller
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
        $flagUserLocations = DB::SELECT("SELECT user_location from userDetail where username = '".$this->userLogin."'");
        foreach ($flagUserLocations as $flagUserLocation) {
            $this->userLoginLocation = $flagUserLocation->user_location;
        }
	}
	public function group($idgroup)
	{
		$members = DB::SELECT("SELECT groupList_username FROM groupListUser WHERE groupList_username = '".$this->userLogin."' AND groupList_groupId = '".$idgroup."'");

		if ($members)
		{
			$data['comments'] = DB::SELECT("SELECT groupComment.* ,userDetail.user_photo , userDetail.user_fullname FROM groupComment, userDetail  where groupComment.groupComment_user = userDetail.username and groupComment.groupComment_groupId = '".$idgroup."' ORDER BY groupComment.groupComment_id desc limit 5");

			$data['jumlah'] = DB::SELECT("SELECT count(*) as hasil, groupList_username from groupListUser where groupList_groupId = '".$idgroup."' ");
			$data['groupdet'] = DB::SELECT("SELECT `group`.* , postEvent.post_text from `group` , postEvent where  `group`.event_Id = postEvent.post_id and `group`.group_id = '".$idgroup."' ");
			return view("dashboard/group",$data);
		}
		else
		{
			return Redirect::to('login');
		}
		
	}

	public function deletegcomment()
	{
		$idgdel = Input::get('post_id');

		$user = Input::get('user');

		$jadi = DB::SELECT("DELETE FROM groupComment where groupComment_id = '".$idgdel."' and groupComment_user = '".$user."'");
		if($jadi) echo "jadii";


	}

	public function doPostgComment()
	{
		$rulesgComment = array(
			'comment' => 'required'
            );
		$groupid = Input::get('idgroup');
		 $validatorPost = Validator::make(\Input::all(), $rulesgComment);
		 if($validatorPost->fails())
        {
            
            return Redirect::to('group/'.$groupid.'')->withErrors($validatorPost);
        }
        else {
        	$commentfield = Input::get('comment');
        	$commenter = $this->userLogin;

        	$modelcommenting  = new groupComment;
        	$modelcommenting->groupComment_text = $commentfield;
        	$modelcommenting->groupComment_user = $commenter;
        	$modelcommenting->groupComment_groupId = $groupid;
        	$modelcommenting->groupComment_date = date('Y-m-d H:i:s');

        	if($modelcommenting->save())
            {
                return Redirect::to('group/'.$groupid.'');
            }
            else return Redirect::to('group/'.$groupid.'')->with("message_fail","Gagal Comment");

        }



	}
    
    public function moregcomment()
    {
    	$data['comments'] = DB::SELECT("SELECT groupComment.* ,userDetail.user_photo , userDetail.user_fullname FROM groupComment, userDetail  where groupComment.groupComment_user = userDetail.username and groupComment.groupComment_groupId = ".Input::get('groupid')." ORDER BY groupComment.groupComment_id desc limit ".Input::get('counter')."");
    	return view('dashboard/moregcomment', $data);
    }

}
