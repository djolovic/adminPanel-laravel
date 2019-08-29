@extends('layout')

@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Login</h1>
        </div>
        <div class="col-md-8 col-md-offset-2">
            {!! Form::model(['route' => ['admin_users/session.postLogin'], 'method' => 'POST']) !!}

            <div class="form-group">
                {{ Form::label('email', 'e-mail') }}
                {{ Form::text('email', null, array('class' => 'form-control','required'=>'')) }}
                @if ($errors->has('email'))
                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="form-group">
                {{ Form::label('password', 'Password') }}
                {{ Form::text('password', null, array('class' => 'form-control','required'=>'')) }}
                @if ($errors->has('password'))
                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                @endif
            </div>

            {{ Form::submit('Login', array('class' => 'btn btn-default')) }}

            {!! Form::close() !!}


        </div>

    </div>
@endsection