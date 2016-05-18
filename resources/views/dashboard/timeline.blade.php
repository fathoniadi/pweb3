@extends('dashboard.layouts.layout')
@section('right-col')
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
  <div class="well">
       <h4 style="display:inline">New Post</h4>
       <a href="#" class="pull-right" show="0" id="newPost">Show</a>
     <div class="well-content" style="margin-top: 1.5em;display:none"  id="well-content"> 
       <form class="form" method="POST" action="{{url('/')}}/doPostEvent" style="margin: 0 auto" enctype="multipart/form-data">
        <div class="input-group" style="margin-bottom: 10px;width:100%;">
          <input type="text" class="form-control" name="nama_event" placeholder="Nama Event">
          <!-- <span class="input-group-btn"><button class="btn btn-lg btn-primary" type="button">OK</button></span> -->
        </div>
        <div class="input-group" style="margin-bottom: 10px;width:100%;">
          <textarea class="form-control" name="deskripsi_event" rows="5" placeholder="Deskripsi"></textarea>
          <!-- <span class="input-group-btn"><button class="btn btn-lg btn-primary" type="button">OK</button></span> -->
        </div>
        <div class="input-group" style="margin-bottom: 10px;width:100%;">
          <input type="datetime-local" name="waktu_event" title="Waktu Event" class="form-control" placeholder="Waktu Event">
          <!-- <span class="input-group-btn"><button class="btn btn-lg btn-primary" type="button">OK</button></span> -->
        </div>
        <div class="input-group" style="margin-bottom: 10px;width:100%;">
          <select class="form-control" id="location" name="lokasi_event">
             <option value="">Pilih Kota</option>
             <option value="1">Jakarta</option>
             <option value="2">Tangerang</option>
             <option value="3">Bekasi</option>
             <option value="4">Bandung</option>
             <option value="5">Bogor</option>
             <option value="6">Semarang</option>
             <option value="8">Solo</option>
             <option value="7">Yogyakarta</option>
             <option value="9">Surabaya</option>
             <option value="10">Klaten</option>
          </select>
        </div>
        <div class="input-group" style="margin-bottom: 10px;width:100%;">
          <a href="#" flag="0" id="addGambar">Tambahkan gambar</a>
          <input style="display:none" type="file" id="gambarPendukung" name="gambar_event" title="Gambar pendukung" class="form-control" placeholder="Gambar pendukung">
          <!-- <span class="input-group-btn"><button class="btn btn-lg btn-primary" type="button">OK</button></span> -->
        </div>
        <div class="input-group" style="margin-left:auto; margin-right:0;" >
          <input type="hidden" name="_token" value="{{csrf_token() }}">
          <button  class="btn btn-primary">Post</button>
        </div>
      </form>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-body" style="text-align:center">
      <span class="pull-right">Show More</span>
    </div>
 </div>
 <div id="postList">
    @if($posts)
      @foreach($posts as $post)
        <div class="panel panel-default">
         <div class="panel-heading">
          @if($post->post_owner == base64_decode(base64_decode(Session::get('user'))))
            <li class="dropdown">
              <a href="#" class="pull-right dropdown-toggle" data-toggle="dropdown">Action</a>
                <ul class="pull-right dropdown-menu">
                  <li><a href="#">Edit</a></li>
                  <li><a href="#">Delete</a></li>
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
            <div style="border-top:1px solid">
              <h4>{{$post->user_fullname}}</h4>
              <p style="display:inline">{{$post->post_date}}</p>
            </div>
            <div class="clearfix"></div>
            <div class="commentList" style=" border-top:1px solid; margin-top:18px">
              <div class="Comment-Action" style="padding:5px 20px;text-align:center;">
                <a href="">Load More Comment</a>
              </div>
              <div class="Comment-Content">
                <div class="photo-comment">
                  <img src="//placehold.it/150x150">
                </div>
                <h4>Ini Nama</h4>
                <p style="display:inline;>If you're looking for help with Bootstrap code, the <code>twitter-bootstrap</code> tag at <a href="http://stackoverflow.com/questions/tagged/twitter-bootstrap">Stackoverflow</a> is a good place to find answers.asdsasdasdasdsadddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd</p>
                <p>2 Oktober 2016</p>
              </div>
            </div>
            
            <div class="input-group" style="margin-top:10px">
              <div class="input-group-btn">
                <button flagLike="@if(in_array($post->post_id, $liked)){{1}}@else{{0}} @endif" post-id="{{$post->post_id}}" title="Like" class="@if(in_array($post->post_id, $liked)) {{'btn btn-info active tolike'}} @else{{'btn btn-default tolike'}} @endif"><i class="material-icons" style="font-size:14px">plus_one</i></button>
                <button flagJoin="@if(in_array($post->post_id, $joined)){{1}}@else{{0}} @endif" post-id="{{$post->post_id}}" title="Join" class="@if(in_array($post->post_id, $joined)) {{'btn btn-warning active tojoin'}} @else{{'btn btn-default tojoin'}} @endif"><i class="material-icons" style="font-size:14px;">group_add</i></button>
              </div>
            <form class="formComment" post-id="{{$post->post_id}}">
              <input type="text" id="inputComment{{$post->post_id}}" post-id="{{$post->post_id}}" name="comment" class="form-control" placeholder="Add a comment..">
              <input type="hidden" id="token{{$post->post_id}}" name="_token" value="{{csrf_token() }}">
            </div>
            </form>
            </div>
        </div>
        @endforeach
      </div>
 

 <div id="showmore{{$post->post_id}}" class="panel panel-default">
    <div class="panel-body" style="text-align:center">
      <span class="more" last-id="{{$post->post_id}}">Show More</span>
      <form><input type="hidden" id="tokenmore{{$post->post_id}}" name="_token" value="{{csrf_token() }}"></form>
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
    <div class="panel-heading"><a href="#" class="pull-right">View all</a> <h4 style="display:inline">Your Post</h4></div>
      <div class="panel-body">
        <div class="list-group">
          <a href="http://bootply.com/tagged/modal" class="list-group-item">Modal / Dialog</a>
          <a href="http://bootply.com/tagged/datetime" class="list-group-item">Datetime Examples</a>
          <a href="http://bootply.com/tagged/datatable" class="list-group-item">Data Grids</a>
        </div>
      </div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading"><a href="#" class="pull-right">View all</a> <h4 style="display:inline">Your Joined Post</h4></div>
      <div class="panel-body">
        <div class="list-group">
          <a href="http://bootply.com/tagged/modal" class="list-group-item">Modal / Dialog</a>
          <a href="http://bootply.com/tagged/datetime" class="list-group-item">Datetime Examples</a>
          <a href="http://bootply.com/tagged/datatable" class="list-group-item">Data Grids</a>
        </div>
      </div>
  </div>
</div>
@endsection