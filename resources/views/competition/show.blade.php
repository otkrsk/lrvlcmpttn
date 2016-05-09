@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="">
        <h2>{{ $competition->id }}: {{ $competition->name }}</h2>
      </div>
      <div class="">
        <a href="{{ route('submission.create') }}?competition={{ $competition->id }}">Create a submission</a>
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
              {{ $submission->id }}: {{ $submission->name }} | <small>{{ date('d M, Y', strtotime($submission->created_at)) }} ({{ $submission->created_at->diffForHumans() }})</small><br>
              @if($submission->user->id !== Auth::user()->id)
                @if(Auth::user()->hasLikedSubmission($submission))
                  <small><a href="{{ route('submission.unlike', ['submissionId' => $submission->id]) }}">Unlike</a> | </small>
                @else
                  <small><a href="{{ route('submission.like', ['submissionId' => $submission->id]) }}">Like</a> | </small>
                @endif
              @endif
              <small>{{ $submission->likes->count() }} {{ str_plural('like', $submission->likes->count()) }}</small>
            </div>
          @endforeach
        @endif
      </div>

    </div>
  </div>
</div>

@endsection
