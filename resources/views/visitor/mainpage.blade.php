@extends('layouts\visitorMain')
@section('content')
@if($message = Session::get('visitor'))
<div class="alert alert-danger">
	
		
		<strong>{{ $message }} </strong>
	
	</div>
@endif

 <section id="hero" class="d-flex flex-column justify-content-center align-items-center">
    <div class="container text-center text-md-left" data-aos="fade-up">
      <h1>Welcome to <span>knowledge world</span></h1>
  
	</div>
  </section><!-- End Hero -->
@endsection