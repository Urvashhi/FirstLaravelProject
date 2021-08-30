
@extends('layouts\admin1')
 

@section('content')
   
@if($message = Session::get('success'))
<div class="alert alert-success">
    
        
        <strong>{{ $message }} </strong>
    
    </div>
@endif
@if($message = Session::get('error'))
<div class="alert alert-danger">
    
        <input type="button" class="close" data-dismiss="alert">x</button>
        <strong>{{ $message }} </strong>
    
    </div>
@endif

 		   
<form method="post" action="/approve_request" id="form1">


@if(count($errors)>0)
    <div class="alert alert-danger">
    <ul>
    @foreach($errors->all() as $error)
        <li> {{ $error }}</li>
    @endforeach
    </ul>
    </div>
@endif

{{ csrf_field() }}
<input name="id" type="hidden" class="form-control" value="{{ $book->id }}"> 
<input name="first_name" type="hidden" class="form-control" value="{{ $book->first_name }}">
<input name="email" type="hidden" class="form-control" value="{{ $book->email }}">  
	<input name="id2" type="hidden" class="form-control" value="{{ $book1->id }}"> 

<label>Satus:</label>
<input name="approve" type="text" class="form-control"  placeholder="Yes or No" id="approve" value=""> 
<br>
<!--
<label>Issue Date:</label> 
    <input class="date form-control" name="issue_date" type="text" placeholder="Issue_date">
<script type="text/javascript">

    $('.date').datepicker({  

       format: 'dd-mm-yyyy'

     });  

</script> 
<label>Return Date:</label> 
    <input class="date form-control" name="Return_date" type="text" placeholder="Return_date">
<script type="text/javascript">

    $('.date').datepicker({  

       format: 'dd-mm-yyyy'

     });  

</script> 
-->
<label >Issue Date:</label>
<input name="issue_date" type="text" class="form-control"  placeholder="Issue_date" id="issue_date" value="">
<br>
<label >Return Date:</label>
<input name="return_date" type="text" class="form-control"  placeholder="Return_date" id="ieturn_date" value="">
<br>


    
<center><input name="Submit" type="Submit" class="btn btn-primary">  </center>



 </form>
@endsection
