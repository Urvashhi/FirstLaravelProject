
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Ample lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Ample admin lite dashboard bootstrap 5 dashboard template">
    <meta name="description"
        content="Ample Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>Ashi's Book</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/ample-admin-lite/" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="plugins/images/favicon.png">
    <!-- Custom CSS -->
    <link href="plugins/bower_components/chartist/dist/chartist.min.css" rel="stylesheet">
    <link rel="stylesheet" href="plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css">
    <!-- Custom CSS -->
    <link href="css/style.min.css" rel="stylesheet">
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                  
                        <!-- Logo icon -->
                        <b class="logo-icon">
                            <!-- Dark Logo icon -->
                            <center>ADMIN PANEL</center>
						   </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                            <!-- dark Logo text -->
                            
                        </span>
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none"
                        href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                   
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav ms-auto d-flex align-items-center">
						 <li class="text-center p-20 upgrade-btn">
                            <a href="/logout"
                                class="btn d-grid btn-danger text-white" >
                                Logout</a>
                        </li>
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!-- User Profile-->
                        <li class="sidebar-item pt-2">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/successlogin"
                                aria-expanded="false">
                                <i class="far fa-clock" aria-hidden="true"></i>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
          
						
						<li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/change_password"
                                aria-expanded="false">
                                <i class="fa fa-key" aria-hidden="true"></i>
                                <span class="hide-menu">Change Password</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/user_profile"
                                aria-expanded="false">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <span class="hide-menu">User Profile</span>
								
                            </a>
                        </li>
                        
						<li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/book_list"
                                aria-expanded="false">
                                <i class="fa fa-table" aria-hidden="true"></i>
                                <span class="hide-menu">Book Table</span>
                            </a>
                        </li>
                        
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/add_book"
                                aria-expanded="false">
                                <i class="fa fa-book" aria-hidden="true"></i>
                                <span class="hide-menu">Add Book</span>
                            </a>
                        </li>
						
                    </ul>

                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"></h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            <ol class="breadcrumb ms-auto">
                                <li><a href="#" class="fw-normal"></a></li>
                            </ol>
                            
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Three charts -->
                <!-- ============================================================== -->
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-12">



@if($message = Session::get('bookupdate'))
<div class="alert alert-success">
	
		
		<strong>{{ $message }} </strong>
	
	</div>
@endif
@if($message = Session::get('editid'))
<div class="alert alert-danger">
	
		
		<strong>{{ $message }} </strong>
	
	</div>
@endif
@if($message = Session::get('failupdate'))
<div class="alert alert-danger">
	
		
		<strong>{{ $message }} </strong>
	
	</div>
@endif
<form method="post" action="{{ url('/update_book') }}" id="form1" enctype="multipart/form-data">

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
<input type="hidden" name="id" value="{{ $book->id }}"  >
<label>Isbn:</label>
<input name="isbn" type="text" class="form-control" id="isbn" value="{{ $book->isbn }}"> 
<br>
<label>Title:</label>
<input name="title" type="text" class="form-control" id="title" value="{{ $book->title }}"> 
<br>
<label>Author:</label>
<input name="author" type="text" class="form-control" id="author" value="{{ $book->author }}"> 
<br>
<label>Publisher:</label>
<input name="publisher" type="text" class="form-control" id="publisher" value="{{ $book->publisher }}"" > 
<br>
<!--<label>Year:</label>
<input name="year" type="text" class="form-control" id="year" value="{{ old('year') }}" > 
<br>-->
<label>Year:</label>
<select name="year" id="ddlYears" class="form-control" value="{{ $book->year }}"  @php if($book->year) { echo "select=selected"; } @endphp></select>
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
<label>Description:</label>
<input name="description" value="{{ $book->description }}"></input> 
<br><br>

<label>Language:</label><br>
<input name="lang" value="{{ $book->lang }}" class="form-control" ></input> 
<!--<textarea name="description" class="form-control" ></textarea>-->
<br><br>
<label>Category:</label>
<input name="category" type="text" class="form-control" id="category" value="{{ $book->category }}" >
<br><br>
<label>Quantity:</label>
<input name="quantity" type="text" class="form-control" id="quantity" value="{{ $book->quantity }}"" >
<br>
<label>Image:</label>
 <input type="file" name="image" class="form-control" value="{{old('image',$book->image)}}{!! old('image',$book->image) !!}">
 
    <img src="{{ asset('upload/'.old('image',$book->image)) }}" value="{{$book->image or old('image')}}" width="70px" height="80" alt="" title="">        


<center><input name="update" type="Submit" class="btn btn-primary">  </center>
 </form>

 </div>
                    
                <!-- ============================================================== -->
                <!-- PRODUCTS YEARLY SALES -->
                <!-- ============================================================== -->
                
                </div>
				
				 <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
               
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ==================================
                <!-- ============================================================== -->
               
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center"> Ashi's Book 
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/app-style-switcher.js"></script>
    <script src="plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.js"></script>
    <!--This page JavaScript -->
    <!--chartis chart-->
    <script src="plugins/bower_components/chartist/dist/chartist.min.js"></script>
    <script src="plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="js/pages/dashboards/dashboard1.js"></script>
</body>

</html>

 