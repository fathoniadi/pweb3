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
  <div id="showmore{{$post->post_id}}" class="panel panel-default">
    <div class="panel-body" style="text-align:center">
      <span class="more" last-id="{{$post->post_id}}">Show More</span>
      <form><input type="hidden" id="tokenmore{{$post->post_id}}" name="_token" value="{{csrf_token() }}"></form>
    </div>
  </div>
@else
 <div class="panel panel-default">
    <div class="panel-body" style="text-align:center">
      <span>Mentok Bos</span>
    </div>
 </div>
@endif