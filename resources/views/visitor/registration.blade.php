@extends('layouts\visitorMain')
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 
     <link href="style.css" rel="stylesheet" type="text/css" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  

@section('content')
<form method="post" action="{{ url('/saveData') }}" id="form1" enctype="multipart/form-data">

@if($message = Session::get('bookupdate'))
<div class="alert alert-success">
    
        
        <strong>{{ $message }} </strong>
    
    </div>
@endif

@if($message = Session::get('failtores'))
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
<label>First Name:</label>
<input name="first_name" type="text" class="form-control" id="first_name" value="{{ old('first_name') }}"  placeholder="First Name"> 
<br>
<label>Last Name:</label>
<input name="last_name" type="text" class="form-control" id="last_name" value="{{ old('last_name') }}"  placeholder="Last Name"> 
<br>
<label>Email:</label>
<input name="email" type="text" class="form-control" id="email" value="{{ old('email') }}"  placeholder="Email"> 
<br>
<label>Password:</label>
<input name="password" type="password" class="form-control" id="password" value="{{ old('password') }}"  placeholder="Password"> 
<br>
<label>Confirm Password:</label>
<input name="confirm_password" type="password" class="form-control" id="confirm_password" value="{{ old('confirm_password') }}"  placeholder="Confirm password"> 
<br>
<div>
     <label>Gender:</label>
        <input type="radio" name="gender" value="Male" >
        <label for="male">Male</label><br>
        <input type="radio" name="gender" value="Female">
        <label for="female">Female</label><br>
    
    </div>

     <br>
<label>Mobile_no:</label>
<input name="mobile_no" type="text" class="form-control" id="mobile_no" value="{{ old('mobile_no') }}"  placeholder="Address">
<br>

<!--<label>Birthdate:</label>

<input name="birthdate" type="text" class="form-control" id="birthdate" value="{{ old('birthdate') }}" > 
<br>-->
<div>
<?php //date picker library?>
<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


       <label> Birthdate:</label> 
       <input type="text" name="birthdate" class="disableFuturedate"  class="form-control">
<script>
   $(document).ready(function () {
      var currentDate = new Date();
      $('.disableFuturedate').datepicker({
      format: 'dd/mm/yyyy',
      autoclose:true,
      endDate: "currentDate",
      maxDate: currentDate
      }).on('changeDate', function (ev) {
         $(this).datepicker('hide');
      });
      $('.disableFuturedate').keyup(function () {
         if (this.value.match(/[^0-9]/g)) {
            this.value = this.value.replace(/[^0-9^-]/g, '');
         }
      });
   });
</script>-->
</div>
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>   
<label> Birthdate:</label> 
    <input class="date form-control" name="birthdate" type="text" value="{{ old('birthdate')}}" placeholder="Birthdate">
<script type="text/javascript">

    $('.date').datepicker({  

       format: 'mm-dd-yyyy'

     });  

</script> 

  
<label>Address:</label><br>
<input name="address" value="{{ old('address')}}" class="form-control"  placeholder="Address"></input> <br>
<!--<textarea name="description" class="form-control" ></textarea>-->
     <div class="form-group">
     <label>City:</label>
<select name="city" class="form-control" >
   <option value="" >Select city:</option>
   <!--<option value="Ahemedabad" <?php //if( $data['city'] == "Ahemedabad"){ echo "selected"; } ?> >Ahemedabad</option>   -->
   <option value="Ahemedabad"  >Ahemedabad</option>
   <option value="Surat" >Surat</option>
    <option value="Toronto" >Toronto</option>
    <option value="Ottava" >Ottava</option>
</select>

</div>
<br>
 <!-- Close form-group -->
 <div class="form-group">
 <label>State:</label>
<select name="state" class="form-control" >
   <option value="" >Select State:</option>

    <option value="Gujarat">Gujarat</option>
    
   <option value="Canada">Canada</option>
</select><br>               
<label>Pincode:</label>
 <input name="pincode" type="text" class="form-control" id="pincode" value="{{ old('pincode') }}"  placeholder="Pincode">
 
    <!-- Close form-group -->
    
<br>


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
