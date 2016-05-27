<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Aksi.in</title>
    <meta name="generator" content="Bootply" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="{{url('/')}}/resources/assets/css/bootstrap.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/resources/assets/css/bootstrap-table.css">
    <!--[if lt IE 9]>
      <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link href="{{url('/')}}/resources/assets/css/styles.css" rel="stylesheet">
  </head>
  <body>
<div class="wrapper">
    <div class="box">
        <div class="row row-offcanvas row-offcanvas-left">
            <!-- main right col -->
            <div class="col-sm-12" id="main">
                <!-- top nav -->
                <div class="nav navbar-static-top">  
                    <nav class="navbar navbar-default navbar-fixed-top">
                      <div class="container-fluid">
                        <div class="navbar-header">
                          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span> 
                          </button>
                          <a class="navbar-brand" href="#">Aksi.in</a>
                        </div>
                        <div class="collapse navbar-collapse" id="myNavbar">
                          <ul class="nav navbar-nav navbar-right">
                            <li class="active"><a href="{{url('/')}}/timeline">Timeline</a></li>
                            <li><a href="#">Notification</a></li>
                            <li class="dropdown">
                              <a class="dropdown-toggle" data-toggle="dropdown" href="#">User
                              <span class="caret"></span></a>
                              <ul class="dropdown-menu">
                                <li><a href="#">Change Profile</a></li>
                                <li><a href="#">Setting</a></li>
                                <li><a href="{{url('/')}}/logout">Logout</a></li>
                              </ul>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </nav>
                <!-- /top nav -->
              
                <div class="padding">
                    <div class="full col-sm-9">
                      
                        <!-- content -->                      
                        <div class="row">
                          @yield('left-col')
                          @yield('right-col')
                       </div><!--/row-->
                        <div class="row" id="footer">    
                          <div class="col-sm-6">
                              <p>Aksi.in</p>
                          </div>
                          <div class="col-sm-6">
                            <p>
                            <a href="#" class="pull-right">©Copyright 2013</a>
                            </p>
                          </div>
                        </div>
                    </div><!-- /col-9 -->
                </div><!-- /padding -->
            </div>
            <!-- /main -->
          
        </div>
    </div>
</div>


<!--post modal-->
  <!-- script references -->
  </body>
    <script src="{{url('/')}}/resources/assets/js/jquery.min.js"></script>
    <script src="{{url('/')}}/resources/assets/js/bootstrap.min.js"></script>
    <script src="{{url('/')}}/resources/assets/js/scripts.js"></script>
    <script src="{{url('/')}}/resources/assets/js/bootstrap-table.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $(document).on('click','.newPost',function(e) {
            e.preventDefault();
            var flagShow = $(this).attr('show');
            if(flagShow==1)
            {
               $(".newPost").attr('show',0);
               if($(this).attr('flagNewPost')==1) $(this).text("Show");
               $("#well-content").hide();
            }
            else
            {
               $(".newPost").attr('show',1);
               if($(this).attr('flagNewPost')==1) $(this).text("Hide");
               $("#well-content").show();
            }
        });
    });
    $(document).ready(function() {
      $(document).on('click','#addGambar',function(e) {
            e.preventDefault();
            if($(this).attr('flag')==0)
            {
              $("#gambarPendukung").css('display','');
              $(this).attr('flag','1')
            }
            else
            {
              $("#gambarPendukung").css('display','none');
              $(this).attr('flag','0')
            }
        });
    });
    $(document).ready(function() {
      $(document).on('click','.tolike',function(e) {
            e.preventDefault();
            var flagLike = $(this).attr('flagLike');
            var id = $(this).attr('post-id');
            var token =$("#token").val();
            //alert(token);
            if(flagLike==1)
            {
              $(this).attr('class','btn btn-default tolike');
              $(this).attr('flagLike','0');
              $.ajax({
                type:'POST',
                url:'{{url("/")}}/doUnLike',
                data:'id='+id+'&_token='+token+'&action='+flagLike,
                success:function(response){
                  $("#jumlahLike"+id).text(response);
                }
              });
            }
            else if(flagLike==0)
            {
              $.ajax({
                type:'POST',
                url:'{{url("/")}}/doLike',
                data:'id='+id+'&_token='+token+'&action='+flagLike,
                success:function(response){
                  $("#jumlahLike"+id).text(response);
                }
              });

              $(this).attr('class','btn btn-info tolike active');
              $(this).attr('flagLike','1');
            }

        });
    });
    $(document).ready(function() {
      $(document).on('click','.tojoin',function(e) {
            e.preventDefault();
            var flagJoin = $(this).attr('flagJoin');
            var id = $(this).attr('post-id');
            var token =$("#token").val();
            if(flagJoin==1)
            {
              $(this).attr('class','btn btn-default tojoin');
              $(this).attr('flagJoin','0');
              $.ajax({
                type:'POST',
                url:'{{url("/")}}/doUnJoin',
                data:'id='+id+'&_token='+token+'&action='+flagJoin,
                success:function(response){
                  $("#jumlahJoin"+id).text(response);
                }
              });
            }
            else if(flagJoin==0)
            {
              $(this).attr('class','btn btn-warning tojoin active');
              $(this).attr('flagJoin','1');
              $.ajax({
                type:'POST',
                url:'{{url("/")}}/doJoin',
                data:'id='+id+'&_token='+token+'&action='+flagJoin,
                success:function(response){
                  $("#jumlahJoin"+id).text(response);
                }
              });
            }

        });
    });
    $(document).ready(function() {
      $(document).on('submit','.formComment',function(e) {
           e.preventDefault();
           var id = $(this).attr('post-id');
           var id = $(this).attr('post-id');
           var commentContent = $("#inputComment"+id).val();
           var token = $('#token').val();
           $.ajax({
                type:'POST',
                url:'{{url("/")}}/addComment',
                data:'id='+id+'&_token='+token+'&commentContent='+commentContent,
                success:function(response){
                  alert(response);
                  window.location.reload();
                }
            });
        });
    });
    $(document).ready(function() {
      $(document).on('click','.moreComment',function(e) {
           e.preventDefault();
           var id = $(this).attr('post-id');
           var token = $('#token').val();
           $.ajax({
                type:'POST',
                url:'{{url("/")}}/commentajax',
                data:'id='+id+'&_token='+token,
                success:function(response){
                  $("#commentList"+id).html(response);
                }
            });
           $(this).hide();
        });
    });
    $(document).ready(function() {
      $(document).on('click','.deletecomment',function(e) {
           e.preventDefault();
           var id = $(this).attr('comment-id');
           var token = $('#token').val();
           //alert(id);
           if(confirm('Are you sure to delete this comment?'))
           {
              $.ajax({
                  type:'POST',
                  url:'{{url("/")}}/deletecomment',
                  data:'comment_id='+id+'&_token='+token,
                  success:function(response){
                    //alert(response);
                  }
              });
              window.location.reload();
            }
           
        });
    });
    $(document).ready(function() {
      $(document).on('click','.deletepost',function(e) {
          e.preventDefault();
          var post_id = $(this).attr("post-id");
          var token = $("#token").val();
          if(confirm('Are you sure to delete this post?')) 
          {
            $.ajax({
              type:'POST',
              url:'{{url("/")}}/deletePost',
              data:'post_id='+post_id+'&_token='+token+'&user={{base64_decode(base64_decode(Session::get("user")))}}',
              success:function(response){
                  alert(response);
                  window.location="{{url('/')}}/timeline";
              }
            });
          }
        });
    });
    $(document).ready(function() {
      $(document).on('click','#more',function(e) {
           e.preventDefault();
           var counter = parseInt($(this).attr('counter'))+1;
           var token =$("#token").val();
           var postOrder = $("#orderTimeline").attr('flagSort');
           //alert(counter);
           //alert(postOrder);
           $.ajax({
                type:'POST',
                url:'{{url("/")}}/timelineorder',
                data:'counter='+counter+'&_token='+token+'&flagOrder='+postOrder,
                success:function(response){
                  if(response==-1)
                  {

                    $("#more").text('End of Post');
                  }
                  else
                  {
                    $("#more").attr('counter',counter);
                    $("#postList").html(response);
                  }
                }
              });
        });
    });
    $(document).ready(function() {
      $(document).on('change','#orderTimeline',function(e) {
           e.preventDefault();
           var flagOrder = $(this).val();
           //alert(flagOrder);
           var token = $("#token").val();
           var counter = parseInt($("#more").attr('counter'));
           //alert(counter);
           $(this).attr('flagSort',$(this).val());
           $.ajax({
                type:'POST',
                url:'{{url("/")}}/timelineorder',
                data:'flagOrder='+flagOrder+'&_token='+token+'&counter='+counter,
                success:function(response){
                    $("#postList").html(response);
                }
              });
        });
    });
    $(document).ready(function() {
      $(document).on('click','#popupdelete',function(e) {
           e.preventDefault();
           //alert(flagOrder);
           var token = $("#token").val();
          //alert($(this).attr('post-id'));
          var post_id = $(this).attr('post-id');
          //alert(post_id);
          $.ajax({
                type:'POST',
                url:'{{url("/")}}/deletephotoevent',
                data:'post_id='+post_id+'&_token='+token,
                success:function(response){
                    //$("#postList").html(response);
                    alert(response);
                    window.location.reload();
                }
              });
        });
    });

    $(document).ready(function() {
      $(document).on('click','.deletecomment',function(e) {
          e.preventDefault();
          var post_id = $(this).attr("post-id");
          var token = $("#token").val();
          if(confirm('Are you sure to delete this Comment?')) 
          {
            $.ajax({
              type:'POST',
              url:'{{url("/")}}/deletegComment',
              data:'post_id='+post_id+'&_token='+token+'&user={{base64_decode(base64_decode(Session::get("user")))}}',
              success:function(response){
                  //alert(response);
                  window.location.reload();
              }
            });
          }
        });
    });


  
      $(document).ready(function() {
      $(document).on('click','#morecommentgroup',function(e) {
           e.preventDefault();
           var last_id = $(this).attr('last-id');
           var counter = parseInt($(this).attr('counter')) + 5;
           var token =$("#token").val();
           var groupid = $(this).attr('group');
          // alert(counter);
           $.ajax({
                type:'POST',
                url:'{{url("/")}}/moregcomment',
                data:'last_id='+last_id+'&_token='+token+'&counter='+counter+'&groupid='+groupid,
                success:function(response){
                    $("#morecommentgroup").attr('counter', counter);
                    $("#commentList").html(response);
                }
              });

        });
    });




    </script>
</html>