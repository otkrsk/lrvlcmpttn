@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <h2>Edit Photo Submission</h2>

      <div class="">
        {!! Form::model($submission,
          ['method' => 'PATCH',
          'route' => ['submission.update', $submission->id],
          'files' => true,
          ]) !!}

          <div class="">
            {!! Form::label('name') !!}
            {!! Form::text('name') !!}
          </div>

          <div class="">
            {!! Form::label('description') !!}
            {!! Form::textarea('description') !!}
          </div>

          <div class="">
            {!! Form::label('Image') !!}
            <div class="">
              <img src="{{ URL::to('/')}}/{{ $submission->file_path }}" alt="" />
            </div>

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
