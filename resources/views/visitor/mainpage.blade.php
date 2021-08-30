@extends('layouts\visitorMain')
@section('content')

 <section id="hero" class="d-flex flex-column justify-content-center align-items-center">
    <div class="container text-center text-md-left" data-aos="fade-up">
      <h1>Welcome to <span>knowledge world</span></h1>
  
	</div>
  </section><!-- End Hero -->
  
@if($message = Session::get('success'))
<div class="alert alert-success">
    
        
        <strong>{{ $message }} </strong>
    
    </div>
@endif
 @if($message = Session::get('error'))
<div class="alert alert-danger">
    
        
        <strong>{{ $message }} </strong>
    
    </div>
@endif  
  <form method="get" action="{{ url('/home') }}" id="form" >
<br><br>
      <div class="navbar-nav ms-auto d-flex align-items-center">  
 <input type="text" name="search" class="app-search d-none d-md-block me-3" placeholder="Search here" value={{ request()->query('search') }}><br>
    
                                    
  <center>  <button type="submit"class="btn d-grid btn-danger text-white">  <i class="fa fa-search">Search</i></button></center>
  </div>
  <br>
       
</form>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
        $(document).ready(function(){

            // Number of rows selection
            $("#record_per_page").change(function(){

            // Submitting form
            $("#form").submit();

            });
        });
        </script>   
 
<form method="post" action="{{ url('/cart') }}" id="form1">

<div class="layout_padding gallery_section">
    	<div class="container">
    		<div class="row">
                               
                                    @if(count($books)>0)
                                        @foreach($books as $book)
                                       
    			<div class="col-sm-4">
    				<div class="best_shoes">
    					<p class="best_text">Best Books </p>
    					<a href="singleBook/{{$book->id}}"><div class="shoes_icon"><img src="{{ asset('upload/'.$book->image) }}"></div></a>	
						
						<a class="fancybox" name="image" rel="gallery1" href="{{ asset('upload/'.$book->image) }}" title="Twilight Memories (doraartem)">
				   <img src="{{ asset('upload/'.$book->image) }} " style="width: 75px; height: 75px;" class="img-thumbnail" /></a>
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
					</script>
					</a>
    					<div class="star_text">
    						<div class="left_part">
    							<ul>
    	    						<p class="best_text">{{ $book->title }}</p>
    	    						<p class="best_text">{{ $book->author }}</p>
    	    						 <p class="best_text">{{ $book->category }}</p>
									<!--@php  $book=$book->id;	@phpend
									<!--{{$book}}	-->							
										<center><a href="add_to_cart/{{$book->id}}" class="btn btn-primary">Add To Cart</a></center><br>
									
									<form action="borrow_book" method="post">
										@csrf
										<center><button class="btn btn-success">Borrow Now</button></td></tr></center>
										</form>
								</ul>
    						</div>
    					<!--	<div class="right_part">
    							<div class="shoes_price"> <span style="color: #ff4e5b;">CATEGORY :- <p class="best_text">{{ $book->category }}</p></span></div>
    						</div>-->
    					</div>
    				</div>
    			</div>
									@endforeach
                                  
									@else
                                      
											No result found.
                                        
                                    @endif
                                    </div>
				</div>
							
{!! $books->appends(\Request::except('page'))->render('pagination::bootstrap-4') !!}
  	
	</div>  
            
 </form>
@endsection