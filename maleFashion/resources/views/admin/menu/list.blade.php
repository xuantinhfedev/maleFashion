@extends('admin.main')

@section('content')
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th style="width: 40px; text-align: center">ID</th>
                <th>Name</th>
                <th>Active</th>
                <th>Update</th>
                <th style="width: 100px">Action</th>
                {{-- <th>&nbsp;</th> --}}
            </tr>
        </thead>
        <tbody>
            {!! \App\Helpers\Helper::menu($menus) !!}
        </tbody>
    </table>
@endsection
