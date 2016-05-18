@extends('dashboard.layouts.layout')
@section('right-col')
<div class="col-sm-7">                          
  <div class="well">
       <h4 style="display:inline">New Post</h4>
       <a href="#" class="pull-right" show="0" id="newPost">Show</a>
     <div class="well-content" style="margin-top: 1.5em;display:none"  id="well-content"> 
       <form class="form">
        <div class="input-group text-center">
        <input type="text" class="form-control input-lg" placeholder="Enter your email address">
          <span class="input-group-btn"><button class="btn btn-lg btn-primary" type="button">OK</button></span>
        </div>
      </form>
    </div>
  </div>

 <!-- <div class="panel panel-default">
   <div class="panel-heading"><a href="#" class="pull-right">View all</a> <h4 style="display:inline">Bootply Editor &amp; Code Library</h4></div>
    <div class="panel-body">
      <p><img src="//placehold.it/150x150" class="img-circle pull-right"> <a href="#">The Bootstrap Playground</a></p>
      <div class="clearfix"></div>
      <hr>
      Design, build, test, and prototype using Bootstrap in real-time from your Web browser. Bootply combines the power of hand-coded HTML, CSS and JavaScript with the benefits of responsive design using Bootstrap. Find and showcase Bootstrap-ready snippets in the 100% free Bootply.com code repository.
    </div>
 </div> -->
 <div id="postList">
    <div class="panel panel-default">
     <div class="panel-heading">
          <li class="dropdown">
          <a href="#" class="pull-right dropdown-toggle" data-toggle="dropdown">Action</a>
            <ul class="pull-right dropdown-menu">
              <li><a href="#">Edit</a></li>
              <li><a href="#">Delete</a></li>
            </ul>
        </li>
        <h3 style="display:inline">Ini Judul</h3>
        <h4>Lokasi</h4>
     </div>
      <div class="panel-body">
        <img src="//placehold.it/150x150" style="margin: 0px" class="img-circle pull-right">
        <div class="panel-content" style="margin-right:80px; word-wrap: break-word;">
            <img class="photo-event" src="{{url('/')}}/public/uploads/photo_event/a.png">
            <img class="photo-event" src="{{url('/')}}/public/uploads/photo_event/a.png">
            <img class="photo-event" src="{{url('/')}}/public/uploads/photo_event/a.png">
        </div>
        <span>2 Oktober 2016</span>
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
        <form style="margin-top:10px">
        <div class="input-group">
          <div class="input-group-btn">
          <button class="btn btn-default">+1</button><button class="btn btn-default"><i class="glyphicon glyphicon-share"></i></button>
          </div>
          <input type="text" class="form-control" placeholder="Add a comment..">
        </div>
        </form>
        </div>
    </div>
  </div>

 <div class="panel panel-default">
    <div class="panel-body" style="text-align:center">
      <span>Show More</span>
    </div>
 </div>
</div> 
@endsection
@section('left-col')
<div class="col-sm-5">
                           
  <div class="panel panel-default">
    <div class="panel-thumbnail"><img src="/assets/example/bg_5.jpg" class="img-responsive"></div>
    <div class="panel-body">
      <p class="lead">Urbanization</p>
      <p>45 Followers, 13 Posts</p>
      
      <p>
        <img src="https://lh3.googleusercontent.com/uFp_tsTJboUY7kue5XAsGA=s28" width="28px" height="28px">
      </p>
    </div>
  </div>


  <div class="panel panel-default">
    <div class="panel-heading"><a href="#" class="pull-right">View all</a> <h4 style="display:inline">Bootstrap Examples</h4></div>
      <div class="panel-body">
        <div class="list-group">
          <a href="http://bootply.com/tagged/modal" class="list-group-item">Modal / Dialog</a>
          <a href="http://bootply.com/tagged/datetime" class="list-group-item">Datetime Examples</a>
          <a href="http://bootply.com/tagged/datatable" class="list-group-item">Data Grids</a>
        </div>
      </div>
  </div>

  <div class="well"> 
       <form class="form-horizontal" role="form">
        <h4 style="display:inline">What's New</h4>
         <div class="form-group" style="padding:14px;">
          <textarea class="form-control" placeholder="Update your status"></textarea>
        </div>
        <button class="btn btn-primary pull-right" type="button">Post</button><ul class="list-inline"><li><a href=""><i class="glyphicon glyphicon-upload"></i></a></li><li><a href=""><i class="glyphicon glyphicon-camera"></i></a></li><li><a href=""><i class="glyphicon glyphicon-map-marker"></i></a></li></ul>
      </form>
  </div>

  <div class="panel panel-default">
     <div class="panel-heading"><a href="#" class="pull-right">View all</a> <h4 style="display:inline">More Templates</h4></div>
      <div class="panel-body">
        <img src="//placehold.it/150x150" class="img-circle pull-right"> <a href="#">Free @Bootply</a>
        <div class="clearfix"></div>
        There a load of new free Bootstrap 3 ready templates at Bootply. All of these templates are free and don't require extensive customization to the Bootstrap baseline.
        <hr>
        <ul class="list-unstyled"><li><a href="http://www.bootply.com/templates">Dashboard</a></li><li><a href="http://www.bootply.com/templates">Darkside</a></li><li><a href="http://www.bootply.com/templates">Greenfield</a></li></ul>
      </div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading"><h4 style="display:inline">What Is Bootstrap?</h4></div>
    <div class="panel-body">
      Bootstrap is front end frameworkto build custom web applications that are fast, responsive &amp; intuitive. It consist of CSS and HTML for typography, forms, buttons, tables, grids, and navigation along with custom-built jQuery plug-ins and support for responsive layouts. With dozens of reusable components for navigation, pagination, labels, alerts etc..                          </div>
  </div>
</div>
@endsection