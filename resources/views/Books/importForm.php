


<form method="post" action="{{ url('/import') }}" id="form" enctype="multipart/form-data">
@csrf
      <label>Choose File</label>
   <input type="file" name="file" class="form-control">Choose File</label>
  
  <center>  <button type="submit"class="btn d-grid btn-danger text-white">  <i class="fa fa-search">Search</i></button></center>
  </div>
  <br>
      
</form>


 
