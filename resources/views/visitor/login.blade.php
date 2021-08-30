
@extends('layouts\visitorMain')
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 
     <link href="style.css" rel="stylesheet" type="text/css" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  
@section('title','Login Form')


@php
if(isset($_COOKIE['email']) && isset($_COOKIE['password'])) 
{   $email=$_COOKIE['email'];
    $password=$_COOKIE['password'];
}else{
    $email='';
    $password='';
}
@endphp



@section('content')
    <h1>Login form</h1><br>
@if(isset(Auth::user()->email))
    <script>windows.location="/dashboard";</script>

    
@endif

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

@if($message = Session::get('failtologin'))
<div class="alert alert-danger">
    
        <input type="button" class="close" data-dismiss="alert">x</button>
        <strong>{{ $message }} </strong>
    
    </div>
@endif

<form method="post" action="{{ url('visitor/login') }}" id="form1">

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

<label>Email:</label>
<input name="email" type="text" class="form-control"  placeholder="Email" id="email" value="@php if(!isset($_COOKIE['email'])){ echo old('email'); }else{ echo $email; } @endphp"> 
<br>
<label >Password:</label>
<input name="password" type="password" class="form-control"  placeholder="Password" id="password" value="@php if(!isset($_COOKIE['password'])){ echo old('password'); }else{ echo $password; } @endphp">
<br>

<div class="form-group">
    <!--<label>Keep me signed in</label>-->
    <input type="checkbox" id="remember" name="remember" class="remember"> <label>Remember Me</label><br>
    </div>
    <!--<div class="form-group">
    <!--<label>Keep me signed in</label>-->
    <!--<a href="/admin/change_password">Change_password</a>
    </div>-->
    
<center><input name="login" type="Submit" class="btn btn-primary">  </center>


 <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
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

 </form>
@endsection
