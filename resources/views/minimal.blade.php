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


    <div class="container">


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
	$("div.col-md-10, col-md-offset-1").removeClass("col-md-10").removeClass("col-md-offset-1").addClass("col-md-12");
		$(document).ready(function(){
		    $('[data-toggle="tooltip"]').tooltip(); 

		});
	</script>
</body>
</html>
