
@extends('layouts\visitorMain1')
 
@section('title','Login Form')

@section('content')
<h1>Cart Page</h1>
            
@if(!isset(Auth::user()->email))
    <script>windows.location="/home";</script>

    
@endif
@if($message = Session::get('success'))
<div class="alert alert-success">
    
        
        <strong>{{ $message }} </strong>
    
    </div>
@endif

 <div class="table-responsive">
                                <table class="table text-nowrap">
                                    <thead>
                                       
                                    <tr>
										 <th class="border-top-0">IMAGE</th>
                                        <th class="border-top-0">title</th>
                                        <th class="border-top-0">description</th>
                                        <th class="border-top-0">category</th>
										  <th class="border-top-0">Remove</th>
                                   </tr>
									</thead>
							<tbody>
									
											<tr>
										
                                      @foreach($books as $book)
									  	<td>
                                        	 <a class="fancybox" name="image" rel="gallery1" href="{{ asset('upload/'.$book->image) }}" title="Twilight Memories (doraartem)">
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
					</script></td>
										<td>{{ $book->title }}</td>
										
                                      <td>{{ $book->author }}</td>
									  <td>{{ $book->category }}</td>
									<!--  <td>{{ $book->id }}</td>-->
									@if($book->quantity > 0)
									  <td><label>Only {{ $book->quantity }} left</label></td>
									@else
										 <td><label>Out of stock</label></td>
									 @endif
								<!--	 <td><a href="borrow_noww/{{$book->id}}" class="btn btn-success">Borrow</a></td>-->
                                       
									<td><a href="remove_log/{{$book->cart_id}}" class="btn btn-danger">Remove From Cart</a></td></tr>
                                       
										 @endforeach
                                        </tr>
										<form action="borrow_book" method="post">
										@csrf
										<td><button class="btn btn-success">Borrow Now</button></td></tr>
										</form>
									</tbody>
                                </table>
        
    
           
 </form>
@endsection


 














