@extends('layouts\admin1')
@section('content')
@if(isset(Auth::user()->email))
<div class="alert alert-danger success-block">
	
		
		<strong>Welcome  {{ Auth::user()->email }} </strong>
		Hello ashi millonee
	</div>

@else
	<script>windows.location="/admin";</script>
	
@endif


@endsection