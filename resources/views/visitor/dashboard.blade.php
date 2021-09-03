@extends('layouts\visitorMain1')
@section('content')
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

@if(isset(Auth::user()->email))
<center><h1><strong>Welcome  {{ Auth::user()->first_name }} </strong></h1></center>
 <!--{{ Auth::user()->id }} </strong>-->
 @endif

<form method="get" action="{{ url('/dashboard') }}" id="form" >
<br><br>
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
                    foreach ($record_per_page_arr as $nrow) {
                        if (isset($_GET['record_per_page']) && $_GET['record_per_page'] == $nrow) {
                            //$show=$_SESSION['record_per_page']=$show;
                            echo '<option value="'.$nrow.'" selected="selected">'.$nrow.'</option>';
                        } else {
                            echo '<option value="'.$nrow.'">'.$nrow.'</option>';
                        }
                    }
                    ?>
                </select>
                <span class="paginationtextfield">entries</span>&nbsp;
                </div>
                <br>

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
</form>
<form method="post" action="{{ url('/dashboard') }}" id="form1">

<div class="layout_padding gallery_section">
        <div class="container">
            <div class="row">
                               
                                    @if(count($books)>0)
                                        @foreach($books as $book)
                                       
                    
         
                <div class="col-sm-4">
                    <div class="best_shoes">
                        <p class="best_text">Best Books </p>
                        <a href="singleBook/{{$book->id}}"><div class="shoes_icon"><img src="{{ asset('upload/'.$book->image) }}"></div></a>    
                        <div class="star_text">
                            <div class="left_part">
                                <ul>
                                    
                                 @if($book->quantity > 0)
                                         <div>
                                         <p class="best_text">{{ $book->title }}</p>
                                    <p class="best_text">{{ $book->author }}</p>
                                     <p class="best_text">{{ $book->category }}</p>
                                      <td><label>Only {{ $book->quantity }} left</label></td>
                                       
                                        <form action="/add_to_cart" method="POST">
                            
                                    {{ csrf_field() }}      
                                        
                                        <input type="hidden" name="id" value="{{ $book->id }}"  >
                                        <center><button class="btn btn-primary">Add To Cart</button></center><br>
                                        </form>
                                        </div>
                                    @else
                                        <div > 
                                        <p class="best_text">{{ $book->title }}</p>
                                    <p class="best_text">{{ $book->author }}</p>
                                     <p class="best_text">{{ $book->category }}</p>
                                                <td><label>Out of stock</label></td>
                                        <form action="/add_to_cart" method="POST">
                                        @csrf

                                        <input type="hidden" name="id" value="{{ $book->id }}"  >
                                        <center><button class="btn btn-primary" disabled>Add To Cart</button></center><br>
                                        </form>
                                                </div>
                                     @endif
                                    
                                </ul>
                            </div>
                        <!--    <div class="right_part">
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
        
        
        
            <!--{{$books->appends(['search'=>request()->query('search')])->links('pagination::bootstrap-4')}}-->
 </form>
<div>
<!--@if(Session::get('LoggedUserName'))
              <h1>Welcome {{ session::get('LoggedUserName') }}</h1>       

@if(isset(Auth::user()->email))
<div class="alert alert-danger success-block">
    
        
        <strong>Welcome  {{ Auth::user()->email }} </strong>
            
@if($message = Session::get('updateUser'))
<div class="alert alert-success">
    
        
        <strong>{{ $message }} </strong>
    
    </div>
@endif


    </div>
@if($message = Session::get('failtoedit'))
<div class="alert alert-danger">
    
        
        <strong>{{ $message }} </strong>
    
    </div>
    
@endif

@if($message = Session::get('failtologout'))
<div class="alert alert-danger">
    
        
        <strong>{{ $message }} </strong>
    
    </div>
@endif
@if($message = Session::get('failtoupdate'))
<div class="alert alert-danger">
    
        
        <strong>{{ $message }} </strong>
    
    </div>
@endif

            @endif



@else
    <script>windows.location="/admin";</script>
    
@endif
-->
</div>
<BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR>
@endsection
