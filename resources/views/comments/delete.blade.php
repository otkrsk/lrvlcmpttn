@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="">
        <p>Are you sure you want to delete this comment?</p>
        {!! Form::open([
          'method' => 'DELETE',
          'route' => ['comments.destroy', $comment->id]
        ]) !!}
          <div class="">
            {!! Form::submit('Yes') !!}
          </div>
          <div class="">
            <a href="{{ route('comments.redirect', ['id' => $comment->id]) }}">No</a>
          </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>

@endsection
