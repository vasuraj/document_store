@extends('app')

@section('head_section')
<style>
.panel
{
 
background: #92c7d6;
  background-image: -webkit-radial-gradient(top, circle cover, #97d0e1, #427388 80%);
  background-image: -moz-radial-gradient(top, circle cover, #97d0e1, #427388 80%);
  background-image: -o-radial-gradient(top, circle cover, #97d0e1, #427388 80%);
  background-image: radial-gradient(top, circle cover, #97d0e1, #427388 80%);

 border:none;
 box-shadow: 0px 1px 5px #333;

}

.panel-body
{


 text-shadow: 0px 1px 0px rgb(204, 204, 204), 0px 2px 0px rgb(201, 201, 201), 0px 3px 0px rgb(187, 187, 187), 0px 4px 0px rgb(185, 185, 185), 0px 5px 0px rgb(170, 170, 170), 0px 6px 1px rgba(0, 0, 0, 0.1), 0px 0px 5px rgba(0, 0, 0, 0.1), 0px 1px 3px rgba(0, 0, 0, 0.3), 0px 3px 5px rgba(0, 0, 0, 0.2), 0px 5px 10px rgba(0, 0, 0, 0.25), 0px 20px 20px rgba(0, 0, 0, 0.15);
 color: #FFFFFF;
 font-family: 'League Gothic',Impact,sans-serif;
 letter-spacing: 0.2em;
 text-transform: uppercase;
 text-align: center;
 font-size: 3em;

 line-height:50px;

 margin:20px;


}


</style>
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>

				<div class="panel-body">
				<div >
					<span class="glyphicon glyphicon-list-alt" style="font-size:100px; text-align:center; margin-bottom:20px;"></span> 
					<div>Document Store</div>
					@if (!Auth::check())
					<a href="{{ url('auth/login')}}" class="btn btn-primary" style="text-shadow:none; font-family:arial;  letter-spacing:0; box-shadow:0px 1px 1px #555;">Login</a>
					@endif
				</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
