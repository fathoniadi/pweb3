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
@foreach($posts as $post)                          
  <div class="well">
       <h4 title="Click to add new post" style="display:inline" class="newPost" show="0" flagNewPost="0">Edit Post</h4>
      <!--  <a title="Click to add new post" href="#" class="pull-right newPost" show="0" flagNewPost="1">Show</a> -->
     <div class="well-content" style="margin-top: 1.5em;"  id="well-content"> 
       <form class="form" method="POST" action="{{url('/')}}/doupdatepost" style="margin: 0 auto" enctype="multipart/form-data">
        <div class="input-group" style="margin-bottom: 10px;width:100%;">
          <input type="text" class="form-control" name="nama_event" placeholder="Nama Event" value="{{$post->post_nameEvent}}">
          <!-- <span class="input-group-btn"><button class="btn btn-lg btn-primary" type="button">OK</button></span> -->
        </div>
        <div class="input-group" style="margin-bottom: 10px;width:100%;">
          <textarea class="form-control" name="deskripsi_event" rows="5" placeholder="Deskripsi">{{$post->post_text}}</textarea>
          <!-- <span class="input-group-btn"><button class="btn btn-lg btn-primary" type="button">OK</button></span> -->
        </div>
        <div class="input-group" style="margin-bottom: 10px;width:100%;">
          <?php $waktu_event = str_replace(' ','T',$post->post_date)?>
          <input type="datetime-local" name="waktu_event" title="Waktu Event" class="form-control" value="{{$waktu_event}}" placeholder="Waktu Event">
          <input type="text" name="post_id" class="form-control" style="display:none" hidden="" value="{{$post->post_id}}">
          <!-- <span class="input-group-btn"><button class="btn btn-lg btn-primary" type="button">OK</button></span> -->
        </div>
        <div class="input-group" style="margin-bottom: 10px;width:100%;">
          <select class="form-control" id="location" name="lokasi_event">
             <option value="">Pilih Kota</option>
             <option @if($post->post_location==1){{'selected'}} @endif value="1">Jakarta</option>
             <option @if($post->post_location==2){{'selected'}} @endif value="2">Tangerang</option>
             <option @if($post->post_location==3){{'selected'}} @endif value="3">Bekasi</option>
             <option @if($post->post_location==4){{'selected'}} @endif value="4">Bandung</option>
             <option @if($post->post_location==5){{'selected'}} @endif value="5">Bogor</option>
             <option @if($post->post_location==6){{'selected'}} @endif value="6">Semarang</option>
             <option @if($post->post_location==7){{'selected'}} @endif value="8">Solo</option>
             <option @if($post->post_location==8){{'selected'}} @endif value="7">Yogyakarta</option>
             <option @if($post->post_location==9){{'selected'}} @endif value="9">Surabaya</option>
             <option @if($post->post_location==10){{'selected'}} @endif value="10">Klaten</option>
          </select>
        </div>
        @if($post->post_photo==NULL)
          <div class="input-group" style="margin-bottom: 10px;width:100%;">
            <a href="#" flag="0" id="addGambar">Upload File Gambar Baru</a>
            <input style="display:none" type="file" id="gambarPendukung" name="gambar_event" title="Gambar pendukung" class="form-control" placeholder="Gambar pendukung">
          </div>
        @else
          <div class="input-group" id="deletephoto" style="margin-bottom: 10px;width:100%;">
           <img class="photo-event" src="{{url('/')}}/public/uploads/photo_event/{{$post->post_photo}}">
           <button id="popupdelete" class="btn btn-danger" post-id="{{$post->post_id}}">Delete this picture</button>
          </div>
        @endif
        <div class="input-group" style="margin-left:auto; margin-right:0;" >
          <input type="hidden" name="_token" value="{{csrf_token() }}">
          <button  class="btn btn-primary">Post</button>
        </div>
      </form>
    </div>
  </div>
@endforeach
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
            <a href="http://bootply.com/tagged/modal" class="list-group-item">{{$userJoinedPost->post_nameEvent}}</a>
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
                  <tr><td><a href="http://bootply.com/tagged/modal">{{$userJoinedPost->post_nameEvent}}</a></td></tr>
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