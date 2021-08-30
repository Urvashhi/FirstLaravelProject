
@extends('layouts\adminMainTable')
 
@section('title','Request Page')

@section('content1')
<Center><h1 style="color:blue">Currently Borrow Book</h1></center>
  @if($message = Session::get('success'))
<div class="alert alert-success">
    
        
        <strong>{{ $message }} </strong>
    
    </div>
@endif

 <div class="table-responsive"">
                                <table  class="table text-nowrap">
                                    <thead>
                                       
                                    <tr>
											 <th  class="border-top-0">UserName</th>
										 <th  class="border-top-0">Image</th>
                                        <th  class="border-top-0">Title</th>
                                        <th class="border-top-0"> Author</th>
										 <th  class="border-top-0">Category</th>
                                        <th class="border-top-0"> Sattus</th>
										  <th  class="border-top-0">Issue Date</th>
										   <th  class="border-top-0">Retun Date</th>
                                   </tr>
									</thead>
							<tbody>
									
											<tr>
										
                                      @foreach($issue_book as $book)
									   
									 
									  <td>{{ $book->first_name }}</td>
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
									  <td>{{ $book->approve }}</td>
									  <td>{{ $book->issue_date }}</td>
									 <td>{{ $book->return_date }}</td>
									
										<!--<a  href='{{ url("/user_login/{$book->id}")}}' class="btn btn-dark-gray"  class="fa fa-shopping-cart" data-toggle="blog-tags" data-placement="top" title="Add TO CART" value="Add TO CART" >Add TO CART</a> -->
								
									   <td><form action="/return_book/{{$book->id}}" method="post">
							
									 @csrf		
										
										
										<td><button class="btn btn-primary" >Retun Book</button></td><br>
										</form>
										</td>
											</tr>
									@endforeach
									
									
									
									</tbody>
                                </table>
        
    
           
 </form>
@endsection


 














