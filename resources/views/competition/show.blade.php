@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="">
        <h2>{{ $competition->id }}: {{ $competition->name }}</h2>
      </div>
      <div class="">
        @if(!$competition->is_open)
          <p><em>Competition has been closed.</em></p>
        @else
          <a href="{{ route('submission.create', ['competition' => $competition->id]) }}">Create a submission</a>
        @endif
      </div>
      <div class="">
        <h2>Winners:</h2>
      </div>
      <div class="">
        @if($winners)
          @foreach($winners as $winner)
            <p>{{ $winner->id }}: {{ $winner->name }}
            <br><small>{{ $winner->getAuthor($winner)}}</small></p>
          @endforeach
        @else
          <p>
            There are no winners!
          </p>
        @endif
      </div>
      <div class="">
        <p><a href="{{ route('competition.confirmclose', ['$id' => $competition->id]) }}">Confirm winners and close competition.</a></p>
      </div>
      <div class="">
        <h3>{{ $competition->title }}</h3>
        <p>
          {{ $competition->subtitle }}
        </p>
      </div>
      <div class="">
        <p>
          {{ $competition->instructions }}
        </p>
      </div>

      <div class="">
        <h2>Submissions:</h2>
        @if(count($submissions) > 0)
          @foreach($submissions as $submission)
            <div class="">
              {{ $submission->id }}: {{ $submission->name }} |
              <small>
                @if(!$submission->is_winner)
                  <a href="{{ route('submission.select', ['id' => $submission->id])}}">select as winner</a>
                @else
                  <a href="{{ route('submission.deselect', ['id' => $submission->id])}}">deselect as winner</a>
                @endif
              </small>
              <br><small>{{ date('d M, Y', strtotime($submission->created_at)) }} ({{ $submission->created_at->diffForHumans() }}) | {{ $submission->getAuthor($submission) }}</small><br>
              @if($submission->user->id !== Auth::user()->id)
                <small>
                  @if(Auth::user()->hasLikedSubmission($submission))
                    <a href="{{ route('submission.unlike', ['submissionId' => $submission->id]) }}">Unlike</a> |
                  @else
                    <a href="{{ route('submission.like', ['submissionId' => $submission->id]) }}">Like</a> |
                  @endif
                </small>
              @endif
              <small>{{ $submission->likes->count() }} {{ str_plural('like', $submission->likes->count()) }}</small>
            </div>
            <div class="">
              <?php
                $comments = $submission->getComments($submission);
                $comments = $comments->sortByDesc('created_at');
              ?>
              @foreach($comments as $comment)
                <?php
                  $author = $comment->getCommentAuthor($comment->user_id);
                  $author = $author->toArray();
                  // dd($author[0]['name']);
                ?>
                <p>
                  {{ $comment->body }}
                  <br><small>{{ $author[0]['name'] }} | {{ date('d M Y g:i:s A', strtotime($comment->created_at)) }}</small>
                </p>
              @endforeach
            </div>
            <div class="">
              {!! Form::model($submission, array(
                'route' => array('comments.post', $submission->id)
                )) !!}

                <div class="">
                  {!! Form::textarea('comment') !!}
                </div>

                <div class="">
                  {!! Form::submit('Submit a Comment') !!}
                </div>

              {!! Form::close() !!}
            </div>
          @endforeach
        @endif
      </div>

    </div>
  </div>
</div>

@endsection
