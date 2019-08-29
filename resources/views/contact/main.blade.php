@extends('layout')

@section('content')
    <div class="row">
        <table
                class="table table-striped table-bordered dt-responsive nowrap"
                cellspacing="0"
                width="100%"
        >
            <thead>
            <tr>
                <th><a href="#">E-Mail</a> <i class="fa fa-sort-alpha-asc"></i></th>
                <th><a href="#">Name</a> <i class="fa fa-sort"></i></th>
                <th><a href="#">Message</a> <i class="fa fa-sort"></i></th>
                <th><a href="#">Resolved</a> <i class="fa fa-sort"></i></th>
                <th><a href="#">Created</a> <i class="fa fa-sort"></i></th>
                <th><a href="#">Last updated</a> <i class="fa fa-sort"></i></th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($contacts as $contact)
                <tr>
                    <td>{{$contact->email}}</td>
                    <td>{{$contact->name}}</td>
                    <td>{{$contact->message}}</td>
                    <td>
                        @if($contact->isResolved())
                            <span class="label label-success">Resolved</span>
                        @else
                            <span class="label label-danger">Response Needed</span>
                        @endif
                    </td>
                    <td>{{$contact->created_at}}</td>
                    <td>{{$contact->updated_at}}</td>
                    <td>
                        <a
                                class="btn btn-xs btn-primary"
                                style="float:left"
                                href="{{route('contact.show', $contact->id)}}"
                                data-toggle="tooltip"
                                data-placement="top"
                                data-title="View"
                                data-original-title=""
                                title=""
                        >
                            <i class="fa fa-eye"></i>
                        </a>
                        @if( ! $contact->isResolved())
                            <form method="post" action="{{route('contact.update', $contact->id)}}">
                                {!! method_field('patch') !!}
                                {{csrf_field()}}
                            <button
                                    class="btn btn-xs btn-success"
                                    href=""
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    data-title="Resolved"
                                    data-original-title=""
                                    title=""
                            >
                                <i class="fa fa-check"></i>
                            </button>
                        @endif
                            </form>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
        <div class="pull-right">
            {{$contacts->links()}}
        </div>
    </div>
@endsection
