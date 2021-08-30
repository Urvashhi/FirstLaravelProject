
@extends('layouts\visitorMain')
 
@section('title','Login Form')

@section('content')
<!DOCTYPE html>
    <!-- Page Content -->
    <!-- Single Starts Here -->
    <div class="single-product">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <div class="line-dec"></div>
              <h1>Single Book</h1>
            </div>
          </div>
          <div class="col-md-6">
            <div class="product-slider">
              <div id="slider" class="flexslider">
                <ul class="slides">
                  <li>
                   
				 <center> <a class="fancybox" name="image" rel="gallery1" href="{{ asset('upload/'.$book->image) }}" title="Twilight Memories (doraartem)">
				   <img src="{{ asset('upload/'.$book->image) }} " style="width: 100px; height: 100px;" class="img-thumbnail" /></a>
				   <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
					<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
					<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
					<script>
					$(document).ready(function() {
						$(".fancybox").fancybox({
							openEffect	: 'none',
							closeEffect	: 'none'
						});
					});
					</script></center>
					 </li>

                </ul>
              </div>
         
          <div class="col-md-6">
            <div class="right-content">
             

<input type="hidden" name="id" value="{{ $book->id }}"  >
<label>Isbn:</label>{{ $book->isbn }}
<br><br>
<label>Title:</label>{{ $book->title }} 
<br><br>
<label>Author:</label>{{ $book->author }} 
<br><br>
<label>Publisher:</label>{{ $book->publisher }}  
<br><br>
<label>Description:</label>{{ $book->description }} 
<br><br>
<label>Language:</label>{{ $book->lang }} 
<!--<textarea name="description" class="form-control" ></textarea>-->
<br><br>
<label>Category:</label>{{ $book->category }}
<br><br>
<label>Quantity:</label>
@if($book->quantity > 0)
									  <td><label>Only {{ $book->quantity }}  left</label></td>
			<!--					  <form action="/add_to_cart" method="POST">
@csrf
<input type="hidden" name="id" value="{{ $book->id }}"  >
<center><button class="btn btn-primary">Add To Cart</button></center><br>
</form>-->
									@else
										
										 <td><label>Out of stock</label></td>
									<!--	<form action="/add_to_cart" method="POST">
@csrf
<input type="hidden" name="id" value="{{ $book->id }}"  >
<center><button type="disabled" class="btn btn-primary">Add To Cart</button></center><br>
</form>-->
									 @endif

<br><br>

<!--
<form action="/borrow_book" method="POST">
@csrf
 <center><button class="btn btn-success">Borrow Now</button></center><br>         
</form>--> 
@endsection
