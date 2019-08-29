@extends('layout')

@section('content')
    <div class="row">
        <a class="btn btn-default" href="{{route('users.create')}}">Create New User</a>
        <table
                class="table table-striped table-bordered dt-responsive nowrap"
                cellspacing="0"
                width="100%"
        >
            <thead>
            <tr>
                <th><a href="#">E-Mail</a> <i class="fa fa-sort-alpha-asc"></i></th>
                <th><a href="#">Name</a> <i class="fa fa-sort"></i></th>
                <th><a href="#">Confirmed</a> <i class="fa fa-sort"></i></th>
                <th><a href="#">Created</a> <i class="fa fa-sort"></i></th>
                <th><a href="#">Last updated</a> <i class="fa fa-sort"></i></th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->email}}</td>
                    <td>{{$user->name}}</td>
                    <td>
                        @if($user->isConfirmed())
                            <span class="label label-success">Confirmed</span>
                        @else
                            <span class="label label-info">In Progress</span>
                        @endif
                    </td>
                    <td>{{$user->created_at}}</td>
                    <td>{{$user->updated_at}}</td>
                    <td>
                        <a
                                class="btn btn-xs btn-primary"
                                href="{{route('users.show', $user->id)}}"
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
                                href="{{route('users.edit', $user->id)}}"
                                data-toggle="tooltip"
                                data-placement="top"
                                data-title="Edit"
                                data-original-title=""
                                title=""
                        >
                            <i class="fa fa-pencil"></i>
                        </a>

                        @if( ! $user->isConfirmed())
                            <a
                                    class="btn btn-xs btn-info"
                                    href="{{route('users.activate', $user->id)}}"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    data-title="Activate"
                                    data-original-title=""
                                    title=""
                            >
                                <i class="fa fa-check"></i>
                            </a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pull-right">
            {{$users->links()}}
        </div>
    </div>
@endsection
