@extends('dashboard.layouts.layout')
@section('right-col')
<input type="hidden" id="token" name="_token" value="{{csrf_token() }}">

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
       <h4 title="Click to add new post" style="display:inline" class="newPost" show="0" flagNewPost="0">New Post</h4>
       <a title="Click to add new post" href="#" class="pull-right newPost" show="0" flagNewPost="1">Show</a>
     <div class="well-content" style="margin-top: 1.5em;display:none"  id="well-content"> 
       <form class="form" method="POST" action="{{url('/')}}/doPostgComment" style="margin: 0 auto" enctype="multipart/form-data">
    
        <div class="input-group" style="margin-bottom: 10px;width:100%;">
          <textarea class="form-control" name="comment" rows="5" placeholder="Post A Comment"></textarea>
          <!-- <span class="input-group-btn"><button class="btn btn-lg btn-primary" type="button">OK</button></span> -->
        </div>
      
        
        <div class="input-group" style="margin-left:auto; margin-right:0;" >
          <input type="hidden" name="_token" value="{{csrf_token() }}">
          @foreach($groupdet as $gdet)     
                    <input type="hidden" name="idgroup" value="{{$gdet->group_id}}"></input>
			@endforeach

          <button  class="btn btn-primary">Post</button>
        </div>
      </form>
    </div>
  </div>
  
 <div id="commentList">
    @if($comments)
      @foreach($comments as $comment)

        <div class="panel panel-default">
         <div class="panel-heading" style="padding-bottom: 30px;">
          @if($comment->groupComment_user == base64_decode(base64_decode(Session::get('user'))))
           <!--  <li clss="dropdown">
              <a href="#" class="pull-right dropdown-toggle" data-toggle="dropdown">Action</a>
                <ul class="pull-right dropdown-menu">
                  <li >--><a href="#" class="pull-right">Edit</a></li>
                  <!-- <li> --><a href="#" class="deletecomment pull-right" post-id="{{$comment->groupComment_id}}">Delete&nbsp;</a><!-- </li>
                </ul>
            </li>
 -->
          @endif
       	
         </div>
          <div class="panel-body">
          	@if($comment->user_photo)
            <img src="//placehold.it/150x150" style="margin: 0px" class="img-circle pull-right">
            @endif
            <div class="panel-content" style="margin-right:80px; word-wrap: break-word;">
                <p style="margin-top:10px; font-size:20px">{{$comment->groupComment_text}}</p>
            </div>
            <div class="clearfix"></div>
            <div style="border-top:1px solid; margin-top:20px">
              <h4>{{$comment->user_fullname}}</h4>
              <p style>{{$comment->groupComment_date}}</p>
              <!--  -->
            </div>    
        </div>
       </div>
        @endforeach
  </div>
 

 <div id="showmore{{$comment->groupComment_id}}" class="panel panel-default">
    <div class="panel-body" style="text-align:center">
      <span id="morecommentgroup" group="{{$comment->groupComment_groupId}}" counter="5" last-id="{{$comment->groupComment_id}}">Show More</span>
    </div>
  </div>
@endif
</div> 
@endsection
@section('left-col')

<div class="col-sm-5">
@foreach($groupdet as $gid)     
   <?php $owner = $gid->owner ?>        
  <div class="panel panel-default">
    <div class="panel-thumbnail" style="text-align:center; margin:10px 0px"><img src="//placehold.it/150x150"></div>
    <div class="panel-body" style="word-wrap: break-word;">
      <p class="lead">{{$gid->group_name}}</p>
    <p>{{$gid->post_text}}</p>
   	@foreach($jumlah as $datj) 
      <p>{{$datj->hasil}} members</p>
	@endforeach
    </div>
  </div>
@endforeach



  <div class="panel panel-default">
    <div class="panel-heading"><a href="#" class="pull-right">View all</a> <h4 style="display:inline">Members</h4></div>
      <div class="panel-body">
        <div class="list-group">

 		@foreach($jumlah as $datm)
 		<a href="#" class="list-group-item">{{$datm->groupList_username}} @if($datm->groupList_username == $owner)(Group Admin) @endif</a>
         @endforeach
     
        </div>
      </div>
  </div>

  <!-- < --><!-- div class="panel panel-default">
    <div class="panel-heading"><a href="#" class="pull-right">View all</a> <h4 style="display:inline">Your Joined Post</h4></div>
      <div class="panel-body">
        <div class="list-group">
          <a href="http://bootply.com/tagged/modal" class="list-group-item">Modal / Dialog</a>
          <a href="http://bootply.com/tagged/datetime" class="list-group-item">Datetime Examples</a>
          <a href="http://bootply.com/tagged/datatable" class="list-group-item">Data Grids</a>
        </div>
      </div>
  </div> -->
</div> 
@endsection