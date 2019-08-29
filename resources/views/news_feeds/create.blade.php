@extends('layout')

@section('content')



    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>New Feed</h1>
        </div>
        <div class="col-md-8 col-md-offset-2">
            {!! Form::model(['route' => ['news_feeds.store'], 'method' => 'POST']) !!}
            <div class="form-group">
                {{ Form::label('title', 'Title') }}
                {{ Form::text('title', null, array('class' => 'form-control','required'=>'')) }}
            </div>

            <div class="form-group">
                {{ Form::label('text', 'Text') }}
                {{ Form::textarea('text', null, array('class' => 'form-control', 'rows' => 5,'required'=>'')) }}
            </div>

            <div class="form-group">
                {{ Form::label('link', 'Image') }}
                {{ Form::text('link', null, array('class' => 'form-control','required'=>'')) }}
            </div>

            {{ Form::submit('Create', array('class' => 'btn btn-default')) }}
            {!! Form::close() !!}


        </div>
    </div>
@endsection