@extends('layouts.app')

@section('title', 'My Tickets')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-ticket"> My Tickets</i>
                </div>

                <div class="panel-body">
                    @if ($tickets->isEmpty())
                        <p>You have not created any tickets.</p>
                    @else
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Category</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Priority</th>
                                <th>Last Updated</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($tickets as $ticket)
                                <tr>
                                    <td>
                                        @foreach ($categories as $category)
                                            @if ($category->id === $ticket->category_id)
                                                {{ $category->name }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ url('tickets/'. $ticket->ticket_id) }}">
                                            #{{ $ticket->ticket_id }} - {{ $ticket->title }}
                                        </a>
                                    </td>
                                    <td>
                                        @if ($ticket->status === 'Open')
                                            <span class="label label-success">{{ $ticket->status }}</span>
                                        @else
                                            <span class="label label-danger">{{ $ticket->status }}</span>
                                        @endif
                                    </td>

                                    @if($ticket->priority === 'low')
                                        <td><span class="label label-success">{{ $ticket->priority }}</span></td>
                                    @elseif($ticket->priority === 'high')
                                        <td><span class="label label-danger">{{ $ticket->priority }}</span></td>
                                    @elseif($ticket->priority === 'medium')
                                        <td><span class="label label-warning">{{ $ticket->priority }}</span></td>
                                    @endif

                                    <td>{{ $ticket->updated_at }}</td>
                                    <td><a href="{{ url('tickets/'. $ticket->ticket_id) }}">Edit</a></td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>

                        {{ $tickets->render() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
