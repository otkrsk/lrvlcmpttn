@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="">
        <h2>Competitions</h2>
      </div>
      <div class="">
        <a href="{{ route('competition.create') }}">Create a new competition</a>
      </div>
      @foreach($competitions as $competition)
        <div class="">
          {{ $competition->id }}: {{ $competition->name }} (<a href="{{ URL::to('competition') }}/{{ $competition->id }}">View competition</a>)
        </div>
      @endforeach
    </div>
  </div>
</div>

@endsection
