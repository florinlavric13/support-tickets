@extends('layouts.app')

@section('title', 'All Users')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fas fa-users"> All Users</i>
                </div>

                <div class="panel-body">
                    {{--@if ($user->isEmpty())--}}
                        {{--<p>You have not created any tickets.</p>--}}
                    {{--@else--}}
                        <table class="table">
                            <thead>
                            <tr>
                                <th>User id</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
@endsection
