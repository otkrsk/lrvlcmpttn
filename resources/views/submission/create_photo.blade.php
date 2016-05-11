@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <h2>Create Photo Submission</h2>

      <div class="">
        {!! Form::open(array(
          'route' => 'submission.store',
          'files' => true,
          )) !!}

          {!! Form::hidden('competition_id', $_GET['competition']) !!}
          {!! Form::hidden('submission_type', $type) !!}


          <div class="">
            {!! Form::label('name') !!}
            {!! Form::text('name') !!}
          </div>

          <div class="">
            {!! Form::label('description') !!}
            {!! Form::textarea('description') !!}
          </div>

          <div class="">
            {!! Form::label('file_name') !!}
            {!! Form::file('file_name') !!}
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
