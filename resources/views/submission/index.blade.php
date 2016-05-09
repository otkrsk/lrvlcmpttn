@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="">
        <h2>Submission Index</h2>
      </div>
      
      @if(count($submissions) <= 0)
      No submissions
      @else
        @foreach($submissions as $submission)
          <div class="">
            {{ $submission->id }}
          </div>
        @endforeach
      @endif
    </div>
  </div>
</div>


@endsection
