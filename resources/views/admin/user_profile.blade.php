
@extends('layouts\adminMainTable')
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 
     <link href="style.css" rel="stylesheet" type="text/css" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  


@section('content1')
 




<form method="get" action="/user_profile" id="form" >

      <div class="navbar-nav ms-auto d-flex align-items-center">  
 <input type="text" name="search_user" class="app-search d-none d-md-block me-3" placeholder="Search here" value={{ request()->query('search_user') }}><br>
    
                                    
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
             



<form method="post" action="{{ url('/book_list') }}" id="form1">
@if($message = Session::get('success'))
<div class="alert alert-success">
    
        
        <strong>{{ $message }} </strong>
    
    </div>
@endif
@if($message = Session::get('error'))
<div class="alert alert-success">
    
        
        <strong>{{ $message }} </strong>
    
    </div>
@endif


 <div class="table-responsive">
                                <table class="table text-nowrap">
                                    <thead>
                                       
                                    <tr>
                                        <th class="border-top-0 ">@sortablelink('id')</th>
                                        <th class="border-top-0">@sortablelink('first_name')</th>
                                        <th class="border-top-0">@sortablelink('email')</th>
                                        <th class="border-top-0">@sortablelink('mobile_no')</th>
                                        <th class="border-top-0">@sortablelink('birthdate')</th>
                                        <th class="border-top-0">@sortablelink('city')</th>
                                        <th class="border-top-0">@sortablelink('state')</th>
                                        <th class="border-top-0">Action</th>
                                        
                                    </tr>
                                                                      
                                   </thead>
                                    <tbody>
                                    @if(count($users)>0)
                                        @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->first_name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->mobile_no }}</td>
                                            <td>{{ $user->birthdate }}</td>
                                            <td>{{ $user->city }}</td>
                                            <td>{{ $user->state }}</td>
                                            
                                            <td>
                                                <button class="btn d-grid btn-primary text-white"><a href="/edit_user/{{$user->id}}">Edit</a></button>
                                                    
                                                <br>|<button class="btn btn-danger "><a href="/del/{{$user->id}}">Delete</a></button>
                                        
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
        
         {!! $users->appends(\Request::except('page'))->render('pagination::bootstrap-4') !!}
            <!--{{$users->appends(['search'=>request()->query('search')])->links('pagination::bootstrap-4')}}-->
 </form>
@endsection


 
