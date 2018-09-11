@extends('layouts.app')

@section('title', 'All Users')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-btn fa-users"> All Users</i>
                </div>

                <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>User id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Create At</th>
                                <th>Role</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($items as $item)
                                <?php
//                                dd($items);
                                    $role = $item->role;
                                ?>
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    @if($role === 0)
                                        <td><span class="label label-warning">User</span></td>
                                        @else
                                        <td><span class="label label-success">Admin</span></td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
@endsection
