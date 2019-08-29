@extends('layout')

@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Register</h1>
        </div>
        <div class="col-md-8 col-md-offset-2">
            {!! Form::model(['route' => ['admin_users.store'], 'method' => 'POST']) !!}

            <div class="form-group">
                {{ Form::label('name', 'Name') }}
                {{ Form::text('name', null, array('class' => 'form-control','required'=>'')) }}
            </div>
            <div class="form-group">
                {{ Form::label('email', 'e-mail') }}
                {{ Form::text('email', null, array('class' => 'form-control','required'=>'')) }}
            </div>
            <div class="form-group">
                {{ Form::label('password', 'Password') }}
                {{ Form::text('password', null, array('class' => 'form-control','required'=>'')) }}
            </div>

            {{ Form::submit('Register', array('class' => 'btn btn-default')) }}
            {!! Form::close() !!}


        </div>
    </div>
@endsection