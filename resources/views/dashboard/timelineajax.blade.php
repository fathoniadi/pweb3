@if($posts)
  <?php $counterLike=0; $counterJoin=0;$liked[0]=-1;$joined[0]=-1;?>
  @foreach($userLoginLikeds as $userLoginLiked)
    <?php $liked[++$counterLike]=$userLoginLiked->like_post?>
  @endforeach
  @foreach($userLoginJoineds as $userLoginJoined)
    <?php $joined[++$counterJoin]=$userLoginJoined->join_post?>
  @endforeach
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
        </span></span>
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
      <div id="commentList{{$post->post_id}}" style=" border-top:1px solid; margin-top:18px">
        <div class="Comment-Action" style="padding:5px 20px;text-align:center;">
          <a href="" post-id="{{$post->post_id}}" class="moreComment">Load More Comment</a>
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
@endif