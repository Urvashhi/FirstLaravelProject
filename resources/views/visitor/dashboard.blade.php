@extends('layouts\visitorMain1')
@section('content')
@if(isset(Auth::user()->email))
<div class="alert alert-danger success-block">
	
		
		<strong>Welcome  {{ Auth::user()->email }} </strong>
		
	</div>
<BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR>
@else
	<script>windows.location="/admin";</script>
	
@endif


@endsection