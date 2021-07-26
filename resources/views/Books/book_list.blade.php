@if(!isset(Auth::user()->email))
	<script>windows.location="/home";</script>

	
@endif

@extends('layouts\adminMainTable')
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 
     <link href="style.css" rel="stylesheet" type="text/css" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  
	
@section('content1')
 
<form method="get" action="{{ url('/book_list') }}" id="form" >

      <div class="navbar-nav ms-auto d-flex align-items-center">  
 <input type="text" name="search" class="app-search d-none d-md-block me-3" placeholder="Search here" value={{ request()->query('search') }}><br>
	
                                    
  <center>  <button type="submit"class="btn d-grid btn-danger text-white">  <i class="fa fa-search">Search</i></button></center>
  </div>
  <br>
		 <div>
                <span class="paginationtextfield">Show</span>&nbsp;
                <select id="record_per_page" name="record_per_page">
                    <?php
                    $record_per_page_arr = array("3","5","10","25","50","100","250");
                    foreach($record_per_page_arr as $nrow){
                        if(isset($_GET['record_per_page']) && $_GET['record_per_page'] == $nrow){
							//$show=$_SESSION['record_per_page']=$show;
                            echo '<option value="'.$nrow.'" selected="selected">'.$nrow.'</option>';
                        }else{
                            echo '<option value="'.$nrow.'">'.$nrow.'</option>';
                        }
                    }
                    ?>
                </select>
				<span class="paginationtextfield">entries</span>&nbsp;
                </div>
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
<!--
<div class="navbar-nav ms-auto d-flex align-items-center">
<form action="/search" method="get" class="app-search d-none d-md-block me-3">

                            
    <input type="text" name="search" class="form-control mt-0" placeholder="Search here" value={{ request()->query('search') }}><br>
	
                                    
  <center>  <button type="submit"class="btn d-grid btn-danger text-white">  <i class="fa fa-search">Search</i></button></center>
  <br>
</form>
</div>
-->
<!--<form class="form-inline" method="GET" role="form" action="{{ url('/book_list') }}">

            <div class="form-group">
                            <label for="perPage">Example select:  </label>
                            <select class="form-control" id="perPage" name="perPage">
                                <option>5</option>
                                <option>10</option>
                                <option>15</option>
                                <option>20</option>
                                <option>25</option>
                            </select>
           </div>
</form>-->
<!--
<form method="get" action="{{ url('/user_profile') }}" id="form">

        
       
		 <div>
                <span class="paginationtextfield">Show</span>&nbsp;
                <select id="record_per_page" name="record_per_page">
                    <?php
    /*                $record_per_page_arr = array("3","5","10","25","50","100","250");
                    foreach($record_per_page_arr as $nrow){
                        if(isset($_GET['record_per_page']) && $_GET['record_per_page'] == $nrow){
							//$show=$_SESSION['record_per_page']=$show;
                            echo '<option value="'.$nrow.'" selected="selected">'.$nrow.'</option>';
                        }else{
                            echo '<option value="'.$nrow.'">'.$nrow.'</option>';
                        }
                    }
   */                 ?>
                </select>
				<span class="paginationtextfield">entries</span>&nbsp;
                </div>
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


-->

<form method="post" action="{{ url('/book_list') }}" id="form1">
@if($message = Session::get('deletebook'))
<div class="alert alert-success">
	
		
		<strong>{{ $message }} </strong>
	
	</div>
@endif
 <div class="table-responsive">
                                <table class="table text-nowrap">
                                    <thead>
                                       
									<tr>
										<th class="border-top-0 ">@sortablelink('id')</th>
										<th class="border-top-0">@sortablelink('title')</th>
										<th class="border-top-0">@sortablelink('description')</th>
										<th class="border-top-0">@sortablelink('category')</th>
										<th class="border-top-0">@sortablelink('IMAGE')</th>
										<th class="border-top-0">@sortablelink('ACTION')</th>
								
									</tr>
																	  
                                   </thead>
                                    <tbody>
									@if(count($books)>0)
                                        @foreach($books as $book)
										<tr>
											<td>{{ $book->id }}</td>
											<td>{{ $book->title }}</td>
											<td>{{ $book->description }}</td>
											<td>{{ $book->category }}</td>
											
											 <td><img src="{{ asset('upload/'.$book->image) }}" width="70px" height="80" alt="" title=""></td>
											<td>
												<button class="btn d-grid btn-primary text-white"><a href="/edit_book/{{$book->id}}">Edit</a></button>
													
												<br>|<button class="btn btn-danger "><a href="/delete_book/{{$book->id}}">Delete</a>
										
											</td>
										</tr>
										@endforeach
									@else
										<tr>
								<td>
									No result found.
										</td>
										</tr>
										
									@endif
                                    </tbody>
                                </table>
		
		 {!! $books->appends(\Request::except('page'))->render('pagination::bootstrap-4') !!}
		 
			<!--{{$books->appends(['search'=>request()->query('search')])->links('pagination::bootstrap-4')}}-->
 </form>
@endsection


 