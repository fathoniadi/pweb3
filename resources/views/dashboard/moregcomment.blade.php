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
@endif