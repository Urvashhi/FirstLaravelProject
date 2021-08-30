
@extends('layouts\admin1')
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 
     <link href="style.css" rel="stylesheet" type="text/css" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  

@section('content')
<form method="post" action="/update_user" id="form1" enctype="multipart/form-data">
@if($message = Session::get('updateUser'))
<div class="alert alert-success">
    
        
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
<input type="hidden" name="id" value="{{ $user->id }}"  >
<label>First Name:</label>
<input name="first_name" type="text" class="form-control" id="first_name" value="{{ $user->first_name }}"> 
<br>
<label>Last Name:</label>
<input name="last_name" type="text" class="form-control" id="last_name" value="{{ $user->last_name }}"> 
<br>
<label>Email:</label>
<input name="email" type="text" class="form-control" id="email" value="{{ $user->email }}" > 
<br>
<label>Password:</label>
<input name="password" type="password" class="form-control" id="password" > 
<br>
<div>
     <label>Gender:</label>
        <input type="radio" name="gender" value="Male" @php if($user->gender=="Male") { echo "checked"; } @endphp >
        <label for="male">Male</label><br>
        <input type="radio" name="gender" value="Female" @php if($user->gender=="Female") { echo "checked"; } @endphp >
        <label for="female">Female</label><br>
    
    </div>

     <br>
<label>Mobile_no:</label>
<input name="mobile_no" type="text" class="form-control" id="mobile_no" value="{{ $user->mobile_no }}" >
<br>

<!--<label>Birthdate:</label>

<input name="birthdate" type="text" class="form-control" id="birthdate" value="{{ old('birthdate') }}" > 
<br>-->
<div>
<?php //date picker library?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


       <label> Birthdate:</label> 
       <input type="text" name="birthdate" class="disableFuturedate"  class="form-control" value="{{ $user->birthdate }}" >
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
</script>
</div>
    <br>
    
<label>Address:</label><br>
<input name="address" value="{{ $user->address }}" class="form-control" ></input> <br>
<!--<textarea name="description" class="form-control" ></textarea>-->
     <div class="form-group">
     <label>City:</label>
<select name="city" class="form-control" >
   <option value="" >Select city:</option>
   <!--<option value="Ahemedabad" <?php //if( $data['city'] == "Ahemedabad"){ echo "selected"; } ?> >Ahemedabad</option>   -->
   <option value="Ahemedabad" @php if($user->city=="Ahemedabad") { echo "selected"; } @endphp >Ahemedabad</option>
     
   <option value="Surat" @php if($user->city=="Surat") { echo "selected"; } @endphp>Surat</option>
    <option value="Toronto" @php if($user->city=="Toronto") { echo "selected"; } @endphp>Toronto</option>
    <option value="Ottava" @php if($user->city=="Ottava") { echo "selected"; } @endphp>Ottava</option>
</select>

</div>
<br>
 <!-- Close form-group -->
 <div class="form-group">
 <label>State:</label>
<select name="state" class="form-control" >
   <option value="" >Select State:</option>

    <option value="Gujarat" @php if($user->state=="Gujarat") { echo "selected"; } @endphp > Gujarat</option>
    
   <option value="Canada" @php if($user->state=="Canada") { echo "selected"; } @endphp > Canada</option>
</select><br>               
<label>Pincode:</label>
 <input name="pincode" type="text" class="form-control" id="pincode" value="{{ $user->pincode }}" >
 
    <!-- Close form-group -->
    
<br>


<br>
<center><input name="uodate" type="Submit" class="btn btn-primary">  </center>
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
