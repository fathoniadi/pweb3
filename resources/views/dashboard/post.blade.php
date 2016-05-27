@extends('dashboard.layouts.layout')
@section('right-col')
<input type="hidden" id="token" name="_token" value="{{csrf_token() }}">
<?php $counterLike=0; $counterJoin=0;$liked[0]=-1;$joined[0]=-1;?>
@foreach($userLoginLikeds as $userLoginLiked)
  <?php $liked[++$counterLike]=$userLoginLiked->like_post?>
@endforeach
@foreach($userLoginJoineds as $userLoginJoined)
  <?php $joined[++$counterJoin]=$userLoginJoined->join_post?>
@endforeach
<div class="col-sm-7">
@if ($errors->has()||session('message_fail'))
    <div class="alert-danger" id="errorPost" style="padding:10px">
        <div style="text-align:right; margin-right:10px">
          <span style="font-weight:bold" onclick="$('#errorPost').css('display','none')">Close</span>
        </div>
        @if($errors->has())
          @foreach ($errors->all() as $error)
          <p>{{ $error }}</p>
          @endforeach
        @else <p>{{session('message_fail')}}</p>
        @endif
    </div>
@endif
 <div id="postList">
    @if($posts)
      @foreach($posts as $post)
        <div class="panel panel-default">
         <div class="panel-heading">
          @if($post->post_owner == base64_decode(base64_decode(Session::get('user'))))
            <li class="dropdown">
              <a href="#" class="pull-right dropdown-toggle" data-toggle="dropdown">Action</a>
                <ul class="pull-right dropdown-menu">
                  <li><a href="{{url('/')}}/editpost/{{$post->post_id}}">Edit</a></li>
                  <li><a href="#" class="deletepost" post-id="{{$post->post_id}}">Delete</a></li>
                </ul>
            </li>
          @endif
            <h3 style="display:inline">{{$post->post_nameEvent}}</h3>
            <h4>
            @if($post->post_location==1) {{'Jakarta'}}
            @elseif($post->post_location==2) {{'Tangerang'}}
            @elseif($post->post_location==3) {{'Bekasi'}}
            @elseif($post->post_location==4) {{'Bandung'}}
            @elseif($post->post_location==5) {{'Bogor'}}
            @elseif($post->post_location==6) {{'Semarang'}}
            @elseif($post->post_location==7) {{'Solo'}}
            @elseif($post->post_location==8) {{'Yogyakarta'}}
            @elseif($post->post_location==9) {{'Surabaya'}}
            @elseif($post->post_location==10) {{'Klaten'}}
            @endif

            </h4>
         </div>
          <div class="panel-body">
            <img src="//placehold.it/150x150" style="margin: 0px" class="img-circle pull-right">
            <div class="panel-content" style="margin-right:80px; word-wrap: break-word;">
                @if($post->post_photo)<img class="photo-event" src="{{url('/')}}/public/uploads/photo_event/{{$post->post_photo}}">
                @endif
                <p style="margin-top:10px; font-size:20px">{{$post->post_text}}</p>
            </div>
            <div class="clearfix"></div>
            <div style="border-top:1px solid; margin-top:20px">
              <h4>{{$post->user_fullname}}</h4>
              <p style>{{$post->post_date}}</p>
              <span title="Jumlah like" style="font-size:15px"><i class="material-icons" style="font-size:15px;margin:0;padding:0">plus_one</i> : <span id="jumlahLike{{$post->post_id}}">
                <?php $flagLike=0;?>
                @foreach($jumlahLikePosts as $jumlahLikePost)
                  @if($jumlahLikePost->like_post==$post->post_id) {{$jumlahLikePost->jumlahLikePost}}<?php $flagLike=1;break;?>
                  @endif
                @endforeach
                @if(!$flagLike) {{'0'}}
                @endif
                </span>
              </span>
              <span title="Jumlah joined" style="display:inline;font-size:15px;padding-left:40px"><i class="material-icons" style="font-size:15px;margin:0;padding:0">group_add</i> : <span id="jumlahJoin{{$post->post_id}}">
                <?php $flagJoin=0;?>
                @foreach($jumlahJoinPosts as $jumlahJoinPost)
                  @if($jumlahJoinPost->join_post==$post->post_id) {{$jumlahJoinPost->jumlahJoinPost}}<?php $flagJoin=1;break;?>
                  @endif
                @endforeach
                @if(!$flagJoin) {{'0'}}
                @endif
              </span></span>
            </div>
            <div class="clearfix"></div>
            <?php $counterCommentLists =0;$counterComment=0;?>
              @if($comments)
                @foreach($comments as $dump_comment)
                  @if($dump_comment->comment_post == $post->post_id)
                    <?php $counterCommentLists++; ?>
                  @endif
                @endforeach
              @endif
              @if($counterCommentLists>3)
              <div class="Comment-Action" style="padding:5px 20px;text-align:center; border-top:1px solid">
                  <a href="" post-id="{{$post->post_id}}" class="moreComment">Tampilkan Semua Komentar</a>
              </div>
              @endif
              <div id="commentList{{$post->post_id}}">
              @if($comments)
                @foreach($comments as $comment)
                  @if($comment->comment_post == $post->post_id)
                    @if($counterCommentLists<=3)
                      @if($comment->comment_user == base64_decode(base64_decode(Session::get('user'))) || $post->post_owner == base64_decode(base64_decode(Session::get('user'))))
                         <span href="" class="pull-right deletecomment" comment-id="{{$comment->comment_id}}" style="margin-right:20px; margin-top:10px">Delete</span>
                      @endif
                      <div class="Comment-Content">
                        <div class="photo-comment">
                          <img src="//placehold.it/150x150">
                        </div>
                        <h4>{{$comment->user_fullname}}</h4>
                        <p style="display:inline";>{{$comment->comment_text}}</p>
                        <p>{{$comment->comment_date}}</p>
                      </div>
                    @else
                      @if($counterCommentLists-3<=$counterComment)
                        @if($comment->comment_user == base64_decode(base64_decode(Session::get('user'))) || $post->post_owner == base64_decode(base64_decode(Session::get('user'))))
                         <span href="" class="pull-right deletecomment" comment-id="{{$comment->comment_id}}" style="margin-right:20px; margin-top:10px">Delete</span>
                         @endif
                        <div class="Comment-Content">
                          <div class="photo-comment">
                            <img src="//placehold.it/150x150">
                          </div>
                          <h4>{{$comment->user_fullname}}</h4>
                          <p style="display:inline";>{{$comment->comment_text}}</p>
                          <p>{{$comment->comment_date}}</p>
                        </div>
                      @endif
                    @endif
                   <?php $counterComment++; ?>
                  @endif
                @endforeach
              @endif
            </div>
            
            <div class="input-group" style="margin-top:10px">
              <div class="input-group-btn">
                <button flagLike="@if(in_array($post->post_id, $liked)){{1}}@else{{0}} @endif" post-id="{{$post->post_id}}" title="Like" class="@if(in_array($post->post_id, $liked)) {{'btn btn-info active tolike'}} @else{{'btn btn-default tolike'}} @endif"><i class="material-icons" style="font-size:14px">plus_one</i></button>
                 @if($post->post_owner != base64_decode(base64_decode(Session::get('user'))))
                  <button flagJoin="@if(in_array($post->post_id, $joined)){{1}}@else{{0}} @endif" post-id="{{$post->post_id}}" title="Join" class="@if(in_array($post->post_id, $joined)) {{'btn btn-warning active tojoin'}} @else{{'btn btn-default tojoin'}} @endif"><i class="material-icons" style="font-size:14px;">group_add</i></button>
                @endif
              </div>
            <form class="formComment" post-id="{{$post->post_id}}">
              <input type="text" id="inputComment{{$post->post_id}}" post-id="{{$post->post_id}}" name="comment" class="form-control" placeholder="Add a comment..">
            </div>
            </form>
            </div>
        </div>
        @endforeach
      </div>
    </div> 
@endif
</div>
@endsection
@section('left-col')
<div class="col-sm-5">
@foreach($userInfos as $userInfo)             
  <div class="panel panel-default">
    <div class="panel-thumbnail" style="text-align:center; margin:10px 0px"><img src="//placehold.it/150x150"></div>
    <div class="panel-body" style="word-wrap: break-word;">
      <p class="lead">{{$userInfo->user_fullname}} ({{$userInfo->username}})</p>
      <p>
        @if($userInfo->user_location==1) {{'Jakarta'}}
        @elseif($userInfo->user_location==2) {{'Tangerang'}}
        @elseif($userInfo->user_location==3) {{'Bekasi'}}
        @elseif($userInfo->user_location==4) {{'Bandung'}}
        @elseif($userInfo->user_location==5) {{'Bogor'}}
        @elseif($userInfo->user_location==6) {{'Semarang'}}
        @elseif($userInfo->user_location==7) {{'Solo'}}
        @elseif($userInfo->user_location==8) {{'Yogyakarta'}}
        @elseif($userInfo->user_location==9) {{'Surabaya'}}
        @elseif($userInfo->user_location==10) {{'Klaten'}}
        @endif
      </p>
      <p>{{$userInfo->email}}</p>
    </div>
  </div>
@endforeach
  <div class="panel panel-default">
    <div class="panel-heading"><a href="#" class="pull-right" data-toggle="modal" data-target="#myPosts">View all</a> <h4 style="display:inline">Your Post</h4></div>
      <div class="panel-body">
        <div class="list-group">
        <?php $userPostCounter=0;?>
        @if($userPosts->count())
          @foreach($userPosts as $userPost)
            @if($userPost->post_owner == base64_decode(base64_decode(Session::get('user'))))
              <a href="{{url('/')}}/post/{{$userPost->post_id}}" class="list-group-item">{{$userPost->post_nameEvent}}</a>
              <?php if($userPostCounter==2) 
              {
              ?>
                <a data-toggle="modal" data-target="#myPosts" class="list-group-item">Many More</a>
              <?php
                break;
              }?>
              <?php $userPostCounter++;?>
            @endif
          @endforeach
        @else <span class="list-group-item"">Tidak Ada</span>
        @endif
        </div>
      </div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading"><a href="#" class="pull-right" data-toggle="modal" data-target="#myJoinedPosts">View all</a> <h4 style="display:inline">Your Joined Post</h4></div>
      <div class="panel-body">
        <div class="list-group">
        <?php $userJoinedPostCounter=0;?>
        @if($userJoinedPosts)
          @foreach($userJoinedPosts as $userJoinedPost)
            @foreach($groups as $group)
              @if($userJoinedPost->join_post == $group->Event_id)
                <a href="{{url('/')}}/group/{{$group->group_id}}" class="list-group-item">{{$userJoinedPost->post_nameEvent}}</a>
              <?php break; ?>
              @endif;
            @endforeach
            <?php $userJoinedPostCounter++;?>
            <?php if($userJoinedPostCounter==1) 
              {
              ?>
                <a data-toggle="modal" data-target="#myJoinedPosts" class="list-group-item">Many More</a>
              <?php
                break;
              }?>
          @endforeach
        @else <span class="list-group-item"">Tidak Ada</span>
        @endif
        </div>
      </div>
  </div>
</div>
<div class="modal fade" id="myPosts" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content" style="margin:10px">
        <div class="modal-header">
          <div style="float:left">
           <h4>Your Post</h4>
          </div>
          <div style="display:inline;text-align:right; float:right">
           <span class="button" data-dismiss="modal" style="font-size:24px; display:inline">&times;</span>
          </div>
        </div>
        <div class="modal-body" style="padding:20px">
          <table data-toggle="table" data-pagination="true">
            <thead style="display:none">
            <tr>
                <th style="margin:0;padding:0"></th>
            </tr>
            </thead>
            <tbody>
                @if($userPosts->count())
                @foreach($userPosts as $userPost)
                  @if($userPost->post_owner == base64_decode(base64_decode(Session::get('user'))))
                    <tr><td><a href="{{url('/')}}/post/{{$userPost->post_id}}">{{$userPost->post_nameEvent}}</a></td></tr>
                  @endif
                @endforeach
                @else <tr><td>Tidak Ada</td></tr>
              @endif
            </tbody>
        </table>
        </div>
      </div>
    </div>
</div>
<div class="modal fade" id="myJoinedPosts" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content" style="margin:10px">
        <div class="modal-header">
          <div style="float:left">
           <h4>Your Joined Post</h4>
          </div>
          <div style="display:inline;text-align:right; float:right">
           <span class="button" data-dismiss="modal" style="font-size:24px; display:inline">&times;</span>
          </div>
        </div>
        <div class="modal-body" style="padding:20px">
          <table data-toggle="table" data-pagination="true">
            <thead style="display:none">
            <tr>
                <th style="margin:0;padding:0"></th>
            </tr>
            </thead>
            <tbody>
                @if($userJoinedPosts)
                @foreach($userJoinedPosts as $userJoinedPost)
                  @foreach($groups as $group)
                    @if($userJoinedPost->join_post == $group->Event_id)
                      <tr><td><a href="{{url('/')}}/group/{{$group->group_id}}">{{$userJoinedPost->post_nameEvent}}</a></td></tr>
                      <?php break;?>
                    @endif
                  @endforeach
                @endforeach
              @else <tr><td>Tidak Ada</td></tr>
              @endif
            </tbody>
        </table>
        </div>
      </div>
    </div>
</div>
@endsection