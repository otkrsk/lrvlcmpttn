@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="">
        <p>Are you sure you want to delete this submission?</p>
        {!! Form::open([
          'method' => 'DELETE',
          'route' => ['submission.destroy', $submission->id]
        ]) !!}
          <div class="">
            {!! Form::submit('Yes') !!}
          </div>
          <div class="">
            <a href="{{ route('submission.redirect', ['id' => $submission->id]) }}">No</a>
          </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>

@endsection
