@extends('layouts.app')

@section('content')


<form method="post" action="/messages" class="col-xs-8">
		{{ csrf_field() }}
		<div class="form-group">
		  	<label for="recipient">To</label>
		    <select name="recipient[]" class="form-control" multiple>
		      @if($recipient !== '')
			      	@foreach($recipient as $recipients)	
			      		@foreach ($users as $user)
				      		@if ($user->id === $recipients->id)
				      			<option value="{{ $user->id }}" selected>{{ $user->name }}</option>
				      		@endif
				      	@endforeach
			      	@endforeach
			      	@foreach($users as $user)
			      		@if (in_array($user->id,$recipient_ids))
			      		@else
				      		<option value="{{ $user->id }}">{{ $user->name }}</option>
				      	@endif
				    @endforeach
		      @else
		      	@foreach($users as $user)
		        	<option value="{{ $user->id }}">{{ $user->name }}</option>
		      	@endforeach
		      @endif
			</select>	
		</div>
		<div class="form-group">
		  	<label for="subject">Subject</label>
		  	@if($subject !== '')
		  		<div id="subject">{{ $subject }}</div>
		  		<input type="hidden" id="subject" name="subject" value="{{ $subject }}">
		  	@else
		    	<input type="text" id="subject" name="subject" class="form-control">
		    @endif
		</div>
			<div class="form-group">
			  <label for="body">Body</label>
			  <textarea name="body" id="body" cols="40" rows="5" class="form-control"></textarea>
			</div>
	<div class="row">
		<div class="col-xs-8">
			<button class="btn btn-default" type="submit">Send</button>
		</div>
	</div>
</form>

@endsection