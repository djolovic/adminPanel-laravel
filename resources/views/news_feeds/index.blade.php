@extends('layout')

@section('content')
    <div class="row" style="margin-left: 2%; margin-top: 5%">

            @foreach($newsFeeds as $newsFeed)

            <div class="blog-post">
                <h2 class="blog-post-title">
                    <a href="/admin/news_feeds/{{ $newsFeed->id }}">{{$newsFeed->title}}</a>
                </h2>

                <p class="blog-post-meta">
                    {{ $newsFeed->created_at->toFormattedDateString() }} &nbsp;
                <td>
                    <a
                            class="btn btn-xs btn-primary"
                            href="{{route('news_feeds.show', $newsFeed->id)}}"
                            data-toggle="tooltip"
                            data-placement="top"
                            data-title="View"
                            data-original-title=""
                            title=""
                    >
                        <i class="fa fa-eye"></i>
                    </a>
                    <a
                            class="btn btn-xs btn-info"
                            href="{{route('news_feeds.edit', $newsFeed->id)}}"
                            data-toggle="tooltip"
                            data-placement="top"
                            data-title="Edit"
                            data-original-title=""
                            title=""
                            data-method="edit"
                    >
                        <i class="fa fa-pencil"></i>
                    </a>

                    <a
                            class="btn btn-xs btn-info"
                            href="{{route('news_feeds.delete', $newsFeed->id)}}"
                            data-toggle="tooltip"
                            data-placement="top"
                            data-title="Delete"
                            data-original-title=""
                            title=""
                            data-method="delete"
                    >
                        <i class="fa fa-eraser"></i>
                    </a>

                </td>

                </p>

                {{$newsFeed->text}}

                <br><br>

                <img style="width: 400px; border-radius: 5%" src="{{$newsFeed->link}}">
                <br>

            </div>

            <br>

            @endforeach


        <div class="pull-right">
            {{$newsFeeds->links()}}
        </div>
    </div>
@endsection
