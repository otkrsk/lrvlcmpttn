@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="">
        {!! Form::open(array(
          'route' => 'competition.store',
          )) !!}

          <div class="">
            {!! Form::label('name') !!}
            {!! Form::text('name') !!}
          </div>

          <div class="">
            {!! Form::label('instructions') !!}
            {!! Form::textarea('instructions') !!}
          </div>

          <div class="">
            {!! Form::label('title') !!}
            {!! Form::text('title') !!}
          </div>

          <div class="">
            {!! Form::label('subtitle') !!}
            {!! Form::text('subtitle') !!}
          </div>

          <div class="">
            {!! Form::submit('Submit') !!}
          </div>

        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>

@endsection
