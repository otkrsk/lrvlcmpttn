@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="">
        {!! Form::model($comment,
          ['method' => 'PATCH',
          'route' => ['comments.update', $comment->id]
          ]) !!}

          <div class="">
            {!! Form::label('body') !!}
            {!! Form::textarea('body') !!}
          </div>

          <div class="">
            {!! Form::submit('Edit comment') !!}
          </div>

        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>

@endsection
