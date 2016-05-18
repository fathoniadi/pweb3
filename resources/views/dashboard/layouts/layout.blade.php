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
                            <li class="active"><a href="#">Home</a></li>
                            <li><a href="#">Notification</a></li>
                            <li class="dropdown">
                              <a class="dropdown-toggle" data-toggle="dropdown" href="#">User
                              <span class="caret"></span></a>
                              <ul class="dropdown-menu">
                                <li><a href="#">Page 1-2</a></li>
                                <li><a href="#">Page 1-3</a></li>
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
                      
                        <div class="row">
                          <div class="col-sm-6">
                            <a href="#">Twitter</a> <small class="text-muted">|</small> <a href="#">Facebook</a> <small class="text-muted">|</small> <a href="#">Google+</a>
                          </div>
                        </div>
                      
                        <div class="row" id="footer">    
                          <div class="col-sm-6">
                            
                          </div>
                          <div class="col-sm-6">
                            <p>
                            <a href="#" class="pull-right">©Copyright 2013</a>
                            </p>
                          </div>
                        </div>
                      
                      <hr>
                      
                      <h4 class="text-center">
                      <a href="http://bootply.com/96266" target="ext">Download this Template @Bootply</a>
                      </h4>
                        
                      <hr>
                        
                      
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
    <script type="text/javascript">
      $(document).ready(function() {
        $(document).on('click','#newPost',function(e) {
            e.preventDefault();
            var flagShow = $(this).attr('show');
            if(flagShow==1)
            {
               $(this).attr('show',0);
               $(this).text("Show");
               $("#well-content").hide();
            }
            else
            {
               $(this).attr('show',1);
               $(this).text("Hide");
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
            var token =$("#token"+id).val();
            //alert(token);
            if(flagLike==1)
            {
              $(this).attr('class','btn btn-default tolike');
              $(this).attr('flagLike','0');
              $.ajax({
                type:'POST',
                url:'doUnLike',
                data:'id='+id+'&_token='+token+'&action='+flagLike,
                success:function(response){
                }
              });
            }
            else if(flagLike==0)
            {
              $.ajax({
                type:'POST',
                url:'doLike',
                data:'id='+id+'&_token='+token+'&action='+flagLike,
                success:function(response){
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
            var token =$("#token"+id).val();
            if(flagJoin==1)
            {
              $(this).attr('class','btn btn-default tojoin');
              $(this).attr('flagJoin','0');
              $.ajax({
                type:'POST',
                url:'doUnJoin',
                data:'id='+id+'&_token='+token+'&action='+flagJoin,
                success:function(response){
                }
              });
            }
            else if(flagJoin==0)
            {
              $(this).attr('class','btn btn-warning tojoin active');
              $(this).attr('flagJoin','1');
              $.ajax({
                type:'POST',
                url:'doJoin',
                data:'id='+id+'&_token='+token+'&action='+flagJoin,
                success:function(response){
                  
                }
              });
            }

        });
    });
    $(document).ready(function() {
      $(document).on('submit','.formComment',function(e) {
           e.preventDefault();
           var id = $(this).attr('post-id');
           alert($("#inputComment"+id).val());
        });
    });
    $(document).ready(function() {
      $(document).on('click','.more',function(e) {
           e.preventDefault();
           var last_id = $(this).attr('last-id');
           var token = $("#tokenmore"+last_id).val();
           $.ajax({
                type:'POST',
                url:'timelineajax',
                data:'last_id='+last_id+'&_token='+token,
                success:function(response){
                    $("#showmore"+last_id).remove();
                    $("#postList").append(response);
                }
              });
        });
    });
    </script>
</html>