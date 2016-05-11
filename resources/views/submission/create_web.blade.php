@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <h2>Create Web Submission</h2>

      <div class="">
        {!! Form::open(array(
          'route' => 'submission.store',
          )) !!}

          {!! Form::hidden('competition_id', $_GET['competition']) !!}


          <div class="">
            {!! Form::label('name') !!}
            {!! Form::text('name') !!}
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
