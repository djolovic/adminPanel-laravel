@extends('layout')

@section('content')


        <div class="row" style="margin-left: 2%; margin-top: 5%">

                <div class="blog-post">
                    <h2 class="blog-post-title">
                            {{$newsFeed->title}}
                    </h2>


                    <p class="blog-post-meta">

                        {{ $newsFeed->created_at->toFormattedDateString() }} &nbsp;

                    <br><br>

                    {{$newsFeed->text}}

                    <br>
                        <div>
                    <img style="width: 400px; border-radius: 5%" src="{{$newsFeed->link}}">
                    <br>
                    </div>
                </div>

      </div>

@endsection
