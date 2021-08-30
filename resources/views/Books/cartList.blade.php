
@extends('layouts\visitorMain')
 
@section('title','Login Form')

@section('content')
<h1>Cart Page</h1>
            
<!--@if(!isset(Auth::user()->email))
    <script>windows.location="/home";</script>

    
@endif-->

 @if($message = Session::get('success'))
<div class="alert alert-success">
    
        
        <strong>{{ $message }} </strong>
    
    </div>
@endif
          
 <div class="table-responsive">
                                <table class="table text-nowrap">
                                    <thead>
                                       
                                    <tr>
                                         <th class="border-top-0">Image</th>
                                        <th class="border-top-0">Title</th>
                                        <th class="border-top-0">Author</th>
                                        <th class="border-top-0">Category</th>
                                          <th class="border-top-0">Remove</th>
                                   </tr>
                                    </thead>
                            <tbody>
                                            <tr>
                                    <?php $total = 0 ?>
<!-- by this code session get all product that user chose -->
        @if(session('cart'))
            @foreach(session('cart') as $id => $details)
        <td>
                                             <a class="fancybox" name="image" rel="gallery1" href="{{ asset('upload/'.$details['image']) }}" title="Twilight Memories (doraartem)">
                   <img src="{{ asset('upload/'.$details['image']) }} " style="width: 100px; height: 100px;" class="img-thumbnail" /></a>
                   <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
                    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
                    <script>
                    $(document).ready(function() {
                        $(".fancybox").fancybox({
                            openEffect  : 'none',
                            closeEffect : 'none'
                        });
                    });
                    </script></td>
            <td>{{ $details['title'] }}</td>
                                        
                                      <td>{{ $details['author'] }}</td>
                                      <td>{{ $details['category'] }}</td>
                                     
                                    <td><a href="/remove/{{ $id }}" class="btn btn-danger">Remove From Cart</a></td></tr>
                                         @endforeach
                                        @endif
                     </tr>
                             
                                    </tbody>
                                </table>
        
    
           
 </form>
@endsection


 














