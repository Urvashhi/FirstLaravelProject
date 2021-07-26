

@if(isset(Auth::user()->email))
<div class="alert alert-danger success-block">
	
		
		<strong>Welcome{{ Auth::user()->email }} </strong>
	
	</div>
@endif

Hello ashi millonee