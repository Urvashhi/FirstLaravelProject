
@extends('layouts\visitorMain1')
 
@section('title','Login Form')

@section('content')
<Center><h1 style="color:blue">Borrow Books List</h1></center>
            
@if(!isset(Auth::user()->email))
    <script>windows.location="/home";</script>

    
@endif
@if($message = Session::get('success'))
<div class="alert alert-success">
    
        
        <strong>{{ $message }} </strong>
    
    </div>
@endif
<!--<a href="{{ URL::to('#') }}" >Downloaddd pdf</a>-->
<a class="btn btn-danger" href="{{ URL::to('/book/pdf') }}">Export to PDF</a>


  <!--
  <div class="d-flex flex-row-reverse bd-highlight mb-3">
        <a class="btn btn-success" href="{{ URL::to('/create-pdf') }}">Download PDF</a>
    </div>-->
 <div class="table-responsive">
                                <table class="table text-nowrap">
                                    <thead>
                                       
                                    <tr>
										 <th class="border-top-0">Image</th>
                                        <th class="border-top-0">Title</th>
                                        <th class="border-top-0">Author</th>
										 <th class="border-top-0">Category</th>
                                        <th class="border-top-0">Sattus</th>
										  <th class="border-top-0">Issue Date</th>
										   <th class="border-top-0">Retun Date</th>
										  
										   
                                   </tr>
									</thead>
							<tbody>
									
											<tr>
										
                                      @foreach($issue_book  as $book)
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
									  
									
									  
								  </tr>
										 @endforeach
                                       
										</form>
									</tbody>
                                </table>
        
    
           
 </form>
@endsection


 














