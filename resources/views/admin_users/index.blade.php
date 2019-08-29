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
                <th><a href="#">Created</a> <i class="fa fa-sort"></i></th>
                <th><a href="#">Last updated</a> <i class="fa fa-sort"></i></th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($adminUsers as $adminUser)
                <tr>
                    <td>{{$adminUser->email}}</td>
                    <td>{{$adminUser->name}}</td>
                    <td>{{$adminUser->created_at}}</td>
                    <td>{{$adminUser->updated_at}}</td>
                    <td>
                        <a
                                class="btn btn-xs btn-primary"
                                href="{{route('admin_users.show', $adminUser->id)}}"
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
                                href="{{route('admin_users.edit', $adminUser->id)}}"
                                data-toggle="tooltip"
                                data-placement="top"
                                data-title="Edit"
                                data-original-title=""
                                title=""
                        >
                            <i class="fa fa-pencil"></i>
                        </a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
        <div class="pull-right">
            {{$adminUsers->links()}}
        </div>
    </div>
@endsection
