@extends('layouts\admin1')

 

@section('content')

@if($message = Session::get('success'))
<div class="alert alert-success">
        <strong>{{ $message }} </strong>
</div>
@endif

<div class="alert alert-danger success-block">
        <center><strong><h2>Change Password</h2></strong></center>
    </div>
<form method="post" action="{{ url('admin/update_password') }}" id="passwordVlidation">
@if($message = Session::get('error'))
<div class="alert alert-danger">
    
        <input type="button" class="close" data-dismiss="alert">x</button>
        <strong>{{ $message }} </strong>
    
    </div>
@endif

@if($message = Session::get('failpass'))
<div class="alert alert-danger">
    
        <input type="button" class="close" data-dismiss="alert">x</button>
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
<!--@csrf-->
<div class = "form-group"> 
<label>Old Password:</label>
<input name="old_password" type="password" class="form-control" id="old_password" value="{{old('old_password')}}"  placeholder="Old Password"> 
</div>
<br><br>
<div class = "form-group">
<label>New Password:</label>
<input name="new_password" type="password" class="form-control" id="new_password" value="{{old('new_password')}}"  placeholder="New Password"  placeholder="New Password">
</div>
<br><br>
<div class = "form-group">
    <label>Confirm Password:</label>
<input name="confirm_password" type="password" class="form-control" id="confirm_password" value="{{old('confirm_password')}}"  placeholder="Confirm Password"  placeholder="Confirm Password">

    </div><br>
    
<center><input name="login" type="Submit" class="btn btn-primary">  </center>
<br><br><br><br>
 </form>
 <br><br><br><br><br><br><br><br>
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
    $("#passwordVlidation").validate({
      rules: {
        old_password: {
          required: true,
          minlength: 8
        },
       new_password: {
          required: true,
          minlength: 8
        },
        confirm_password: {
          required: true,
          minlength: 8,
          equalTo:'#new_password'
        }
    },
    messages: {
        old_password: {
           required: "Please Enter Old Password.",
          minlength: "Password must be at least 8 characters long."
        },
        new_password: {
          required: "Please Enter New Password.",
          minlength: "Password must be at least 8 characters long."
        },
        confirm_password: {
          required: "Please Enter Confirm Password.",
          minlength: "Password must be at least 8 characters long."
        }
      }
      
     });
  });

</script>


