
@extends('layouts\visitorMain1')
 
@section('title','Login Form')

@section('content')
<Center><h1 style="color:blue">Borrow Books List</h1></center>
            
@if($message = Session::get('success'))
<div class="alert alert-success">
    
        
        <strong>{{ $message }} </strong>
    
    </div>
@endif
<form action="" method="post">

{{ csrf_field() }}

<label>Name:</label>
<input name="first_name" type="text" class="form-control"  placeholder="first_name" id="first_name" value="{{ old('first_name') }}"> 
<br>
<label>Email:</label>
<input name="email" type="text" class="form-control"  placeholder="Email" id="email" value="{{ old('email') }}"> 
<br>
<label >Address:</label>
<input name="address" type="address" class="form-control"  placeholder="address" id="address" value="{{ old('address') }}">
<br>
    
<center><input name="Borrow Now" type="Submit" class="btn btn-primary">  </center>
</form>
@endsection


 














