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
                <th><a href="#">Created</a> <i class="fa fa-sort"></i></th>
                <th><a href="#">Last updated</a> <i class="fa fa-sort"></i></th>

            </tr>
            </thead>
            <tbody>
                 <tr>
                    <td>{{$contact->email}}</td>
                    <td>{{$contact->name}}</td>
                    <td>{{$contact->message}}</td>
                    <td>{{$contact->created_at}}</td>
                    <td>{{$contact->updated_at}}</td>

                </tr>


            </tbody>
        </table>

    </div>
@endsection
