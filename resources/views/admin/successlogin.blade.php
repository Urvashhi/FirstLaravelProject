@extends('layouts\admin1')
@section('content')

		@if($message = Session::get('error'))
<div class="alert alert-danger">
    
        
        <strong>{{ $message }} </strong>
    
    </div>
@endif
 <h1 style="color:blue"><strong>Welcome  {{ Auth::user()->first_name }} </strong></h1>
<!--@if(Session::get('LoggedAdmin'))
             
<div class="alert alert-danger success-block">
	 <h1>Welcome {{ session::get('LoggedAdmin') }}</h1>		  

		@if(Session::get('LoggedAdminName'))
             
<div class="alert alert-danger success-block">
	 <h1>Welcome {{ session::get('LoggedAdminName') }}</h1>		  
		   
		@endif
		-->
		<div>
		<h1 style="color:blue"><strong>Welcome  {{ Auth::user()->first_name }} </strong></h1>
			@if($message = Session::get('failinsert'))
		<div class="alert alert-danger">
		
			<input type="button" class="close" data-dismiss="alert">x</button>
			<strong>{{ $message }} </strong>
		
		</div>
		@endif
		@if($message = Session::get('faillogout'))
		<div class="alert alert-danger">
		
			<input type="button" class="close" data-dismiss="alert">x</button>
			<strong>{{ $message }} </strong>
		
		</div>
		

	</div>
@endif

<BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR>
@else
	<script>windows.location="/admin";</script>
	
@endif


@endsection