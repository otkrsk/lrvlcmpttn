@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <h2>Create Submission</h2>

      <div class="">
        <a href="{{ route('submission.create', ['competition' => $competition->id, 'type' => 'web']) }}">Web URL</a> | <a href="{{ route('submission.create', ['competition' => $competition->id, 'type' => 'photo']) }}">Upload pictures</a>
      </div>
    </div>
  </div>
</div>

@endsection
