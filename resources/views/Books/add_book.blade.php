@if(!isset(Auth::user()->email))
    <script>windows.location="/admin";</script>

    
@endif

@extends('layouts\admin1')
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 
     <link href="style.css" rel="stylesheet" type="text/css" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  

@section('content')
<form method="post" action="{{ url('admin/save_book') }}" id="form1" enctype="multipart/form-data">
@if($message = Session::get('success'))
<div class="alert alert-success">
    
        
        <strong>{{ $message }} </strong>
    
    </div>
@endif
@if($message = Session::get('failinsert'))
<div class="alert alert-danger">
    
        
        <strong>{{ $message }} </strong>
    
    </div>
@endif

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
<label>Isbn:</label>
<input name="isbn" type="text" class="form-control" id="isbn" value="{{ old('isbn') }}" placeholder="Isbn"> 
<br>
<label>Title:</label>
<input name="title" type="text" class="form-control" id="title" value="{{ old('title') }}" placeholder="Title"> 
<br>
<label>Author:</label>
<input name="author" type="text" class="form-control" id="author" value="{{ old('author') }}" placeholder="Author"> 
<br>
<label>Publisher:</label>
<input name="publisher" type="text" class="form-control" id="publisher" value="{{ old('publisher') }}" placeholder="Publisher"> 
<br>
<!--<label>Year:</label>
<input name="year" type="text" class="form-control" id="year" value="{{ old('year') }}" > 
<br>-->
<label>Year:</label>
<select name="year" id="ddlYears" class="form-control" ></select>
<script type="text/javascript">
    window.onload = function () {
        //Reference the DropDownList.
        var ddlYears = document.getElementById("ddlYears");
 
        //Determine the Current Year.
        var currentYear = (new Date()).getFullYear();
 
        //Loop and add the Year values to DropDownList.
        for (var i = 1900; i <= currentYear; i++) {
            var option = document.createElement("OPTION");
            option.innerHTML = i;
            option.value = i;
            ddlYears.appendChild(option);
        }
    };
</script>
<br>
<label>Description:</label><br>
<input name="description" value="{{ old('description')}}" class="form-control" placeholder="Description"></input> 
<!--<textarea name="description" class="form-control" ></textarea>-->
<br><br>
<label>Language:</label><br>
<input name="lang" value="{{ old('lang')}}" class="form-control" placeholder="Language"></input> 
<!--<textarea name="description" class="form-control" ></textarea>-->
<br><br>
<label>Category:</label>
<input name="category" type="text" class="form-control" id="category" value="{{ old('category') }}" placeholder="Category">
<br><br>
<label>Quantity:</label>
<input name="quantity" type="text" class="form-control" id="quantity" value="{{ old('quantity') }}" placeholder="Quantity">
<br>
<label>Image:</label>
 
                    <input type="file" name="image" class="form-control">
                

<br>
<center><input name="login" type="Submit" class="btn btn-primary">  </center>
 </form>
@endsection


 <?php  //client side validation ?>
 
<link rel="stylesheet" href="css/screen.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js"></script>
<script src="./lib/jquery.js"></script>
<script src="./dist/jquery.validate.js"></script>
<?php
//linkJS("https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js");
//linkJS("https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js");
//linkCSS("assets/css/screen.css");
//linkJS("./lib/jquery.js");
//linkJS("./dist/jquery.validate.js");
?>
<style>
    label.error {
         color: #dc3545;
         font-size: 14px;
    }
</style>
 <script type="text/javascript">

  $().ready(function () {
    $("#form1").validate({
      rules: {
        email: {
          required: true,
          email: true
        },
       password: {
          required: true,
          minlength: 8
        }
    },
    messages: {
        email: {
          required: "Please Enter Email Address.",
          email: "Please Enter a valid Email Address."
        },
        password: {
          required: "Please Enter Password.",
          minlength: "Password must be at least 8 characters long."
        }
      }
      
     });
  });

</script> 
