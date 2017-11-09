@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <a href="/messages/create"><button class="btn btn-default mb-3">New Message</button></a>
            <div class="panel panel-default">
                <div class="panel-heading">Inbox</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table">
                    <tr>
                        <th></th>
                        <th>Delete</th>
                        <th>From</th>
                        <th>Subject</th>
                        <th>Date</th>
                    </tr>
                    @foreach ($messages as $message)
                    
                    
                    @if ($message->is_read)
                    <tr>
                    @else
                    <tr style="font-weight:bold">
                    @endif
                        <td>
                            @if ($message->is_starred) 
                                <strong>&#9734;</strong>
                            @endif
                        </td>
                        <td>
                            <form method="post" action="/messages/{{ $message->id }}">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                    <button class="btn btn-xs btn-default space-right" type="submit"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                            </form>
                        </td>
                        <td><a href="/messages/{{ $message->id }}">{{ $message->sender->name }}</a></td>
                        <td><a href="/messages/{{ $message->id }}">{{ $message->subject }}</a></td>
                        <td><a href="/messages/{{ $message->id }}">{{ $message->created_at->format('m/d/Y') }}</a></td>
                    </tr>
                    @endforeach
                    </table>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Sent</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table">
                    <tr>
                        <th></th>
                        <th>Delete</th>
                        <th>To</th>
                        <th>Subject</th>
                        <th>Date</th>
                    </tr>
                    @foreach ($messagesSent as $messageSent)
                    <tr>
                         <td>
                            @if ($messageSent->is_starred) 
                                <strong>&#9734;</strong>
                            @endif
                        </td>
                        <td>
                            <form method="post" action="/messages/{{ $messageSent->id }}">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                    <button class="btn btn-xs btn-default space-right" type="submit"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                            </form>
                        </td>
                        <td><a href="/messages/{{ $messageSent->id }}">
                            @foreach ($recipients as $recipient)
                                @if($recipient->message_id === $messageSent->id)
                                    {{ $recipient->name . ","}}
                                @endif
                            @endforeach

                        </a></td>
                        <td><a href="/messages/{{ $messageSent->id }}">{{ $messageSent->subject }}</a></td>
                        <td><a href="/messages/{{ $messageSent->id }}">{{ $messageSent->created_at->format('m/d/Y') }}</a></td>
                    </tr>
                    @endforeach
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
