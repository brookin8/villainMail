@extends('layouts.app')

@section('content')
	<div class="container read">
		<div class = "form-group row">
			<a href="/messages/{{ $message->id }}/edit">
				@if ($message->is_starred) 
				<button class="btn btn-warning mr-4">
				@else
				<button class="btn btn-default mr-4">
				@endif
                    <strong>&#9734;</strong>
				</button></a>
			<a href="/messages/create"><button class="btn btn-default">Reply</button></a>
		</div>
		<div class="form-group row">
		  	<label for="sent" class="mr-4">Sent: </label>
		    <div id="sent">{{ $message->created_at->format('m/d/Y') }}</div>
		</div>
		<div class="form-group row">
		@if ($message->sender_id === \Auth::user()->id)
			<label for="sender" class="mr-4">To: </label>
		@else
		  	<label for="sender" class="mr-4">From: </label>
		@endif
		@if ($message->sender_id === \Auth::user()->id)
			@foreach ($recipients as $recipient)
			<div id="sender" class="mr-1">{{ $recipient->name }},</div>
			@endforeach
		@else
			<div id="sender">{{ $message->sender_id }}</div>
		@endif
		</div>
		<div class="form-group row">
		  	<label for="subject" class="mr-4">Subject: </label>
		    <div id="subject">{{ $message->subject }}</div>
		</div>
		<div class="form-group row">
			<div id="body" class="reading">{{ $message->body }}</div>
		</div>
	</div>
@endsection