@foreach($comments as $comment)
<div class="Comment-Content">
  <div class="photo-comment">
    <img src="//placehold.it/150x150">
  </div>
  <h4>{{$comment->user_fullname}}</h4>
  <p style="display:inline";>{{$comment->comment_text}}</p>
  <p>{{$comment->comment_date}}</p>
</div>
@endforeach