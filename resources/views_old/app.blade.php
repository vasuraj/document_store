<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('page_title')</title>

	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	
	{!! Html::style('plugins/jquery-toast/dist/jquery.toast.min.css') !!}
	

	@yield('head_section')
</head>
<body>

	<nav class="navbar navbar-default">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{ url('/') }}"><span class="glyphicon glyphicon-list-alt"></span> Document Store</a>
			</div>
				
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/') }}">Home</a></li>
                    @if (Auth::check())
                    <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                    @if(isset($user_role))
                    @if($user_role=='superadmin')
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Roles/Permissions <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/role_permission') }}">Panel</a></li>

                            <li><a href="{{ URL::route('roles.index') }}">Roles</a></li>
                            <li><a href="{{ URL::route('permissions.index') }}">Permissions</a></li>
                        </ul>
                    </li>
                    @endif
                    @endif

                    @if(isset($user_role))
                    @if($user_role=='admin')
                    <li><a href="{{ URL::route('users.index') }}">Users</a></li>
					@endif
					@endif

                    @if(isset($user_role))
                    <li class="dropdown">
                    	<a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Documents/Amount <span class="caret"></span></a>
                    	<ul class="dropdown-menu" role="menu">
                   		@if($user_role=='admin')
                    		
                    		<li><a href="{{ url('/fileUpload') }}">Upload Blank Template</a></li>
                    		<!-- <li><a href="{{	url('/fileDownload')}}">user Download</a></li> -->
                    		<!-- <li><a href="{{ url('/fileUpload') }}">user Upload</a></li> -->
                    		<li><a href="{{ url('/fileDownload/show') }}/{{date('m')}}/{{date('Y')}}">Users Account summary</a></li>
                    		<!-- <li><a href="{{ url('/show') }}/{{date('m')}}/{{date('y')}}">admin view all</a></li> -->

                    	@elseif($user_role=='user')

                    		
                    		<li><a href="{{	url('/fileDownload')}}">Download Blank Template</a></li>
                    		<li><a href="{{ url('/fileUpload') }}">Upload Edited Document</a></li>
                    		<li><a href="{{ url('/userAmountReceived') }}">Enter amount received</a></li>
                    		<li><a href="{{ url('/fileDownload/show') }}/{{date('m')}}/{{date('Y')}}">Account summary</a></li>
                    		
                    	
                    	@endif
						

                    	</ul>
                    </li>
					@endif
                    @endif
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">Login</a></li>
						<!-- <li><a href="{{ url('/auth/register') }}">Register</a></li> -->
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

    <div class="container" >

        @include('flash::message')
       
        @yield('content')
    </div>

	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

	<!-- notification -->
	{!! Html::script('plugins/jquery-toast/dist/jquery.toast.min.js') !!}
	
	 @if(Session::has('flash_message'))
	 <?php
	 	$msg_array=Session::get('flash_message');
	 	$msg_type=$msg_array['type'];
	 	$msg_heading=$msg_array['heading'];
	 	$msg_body=$msg_array['body'];
	 	
	 ?>
		<script>
		var msg_type='{{$msg_type}}';
		var msg_body='{{$msg_body}}';
		var msg_heading='{{$msg_heading}}';
		var loader='';
		if(msg_type=="error")
		{
			var loader='yellow';
		}
		else if(msg_type=="success")
		{
			var loader='#9EC600';
		}

			$.toast({
			    heading:msg_heading,
			    text: msg_body,
			    showHideTransition: 'slide',
			    icon: msg_type,
			    loader: true,        // Change it to false to disable loader
			    loaderBg:loader,  // To change the background
			    hideAfter: 8000 
			})

		</script>

	        
	 @endif

	@yield('body_end_section')
	<script>
		$(document).ready(function(){
		    $('[data-toggle="tooltip"]').tooltip(); 


		    $("div.col-md-10, .col-md-offset-1").removeClass("col-md-10").removeClass("col-md-offset-1").addClass("col-md-12");
		
		});
	</script>
</body>
</html>
