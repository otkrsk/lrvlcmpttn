@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="competition_title">
        <h2>
        @if(!$competition->is_open)
          <strike>{{ $competition->id }}: {{ $competition->name }}</strike>
        @else
          {{ $competition->id }}: {{ $competition->name }}
        @endif
        <small> | <a href="{{ route('competition.edit', ['id' => $competition->id]) }}">Edit competition</a></small></h2>
      </div>
      <div class="competition_open">
        @if(!$competition->is_open)
          <p><em>Competition has been closed.</em></p>
        @else
          <a href="{{ route('submission.create', ['competition' => $competition->id]) }}">Create a submission</a>
        @endif
      </div>
      <div class="competition_title_subtitle">
        <h3>{{ $competition->title }}</h3>
        <p>
          {{ $competition->subtitle }}
        </p>
      </div>
      <div class="competition_instructions">
        <h3><u>Instructions</u></h3>
        <p>
          {{ $competition->instructions }}
        </p>
      </div>
      <div class="competition_winners">
        <h2>Winners:</h2>
      </div>
      <div class="competition_winner_list">
        @if(count($winners) <= 0)
          <p>
            There are no winners!
          </p>
        @else
          @foreach($winners as $winner)
            <p>{{ $winner->id }}: {{ $winner->name }}
            <br><small>{{ $winner->getAuthor($winner)}}</small></p>
          @endforeach
          <div class="competition_confirm_close">
            <p><a href="{{ route('competition.confirmclose', ['$id' => $competition->id]) }}">Confirm winners and close competition.</a></p>
          </div>
        @endif
      </div>

      <div class="competition_submissions">
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
              <p>
                <small>{{ date('d M, Y', strtotime($submission->created_at)) }} ({{ $submission->created_at->diffForHumans() }}) | {{ $submission->getAuthor($submission) }}</small><br>
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
              </p>
              <p>
                <img src="{{ URL::to('/') }}/{{ $submission->file_path }}" alt="" />
              </p>
              <p>
                {{ $submission->description }}
              </p>
              <p>
                <a href="{{ route('submission.edit', ['id' => $submission->id]) }}">Edit Submission</a> |
                <a href="{{ route('submission.delete', ['id' => $submission->id]) }}">Delete Submission</a>
              </p>
            </div>
            <div class="competition_submissions_comments">
              <div class="">
                <h3>Comments:</h3>
              </div>
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
                  <br>
                  <small>
                    {{ $author[0]['name'] }} | {{ date('d M Y g:i:s A', strtotime($comment->created_at)) }}
                    | <a href="{{ route('comments.edit', ['id' => $comment->id]) }}">Edit comment</a>
                    | <a href="{{ route('comments.delete', ['id' => $comment->id]) }}">Delete comment</a>
                  </small>
                </p>
              @endforeach
            </div>
            <div class="competition_submissions_post_comments">
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
