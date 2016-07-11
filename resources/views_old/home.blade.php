@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>

				<div class="panel-body">
				<div style="font-size:50px; text-align:center;">
					<span class="glyphicon glyphicon-list-alt"></span> 
					<div>Document Store</div>
					@if (!Auth::check())
					<a href="{{ url('auth/login')}}" class="btn btn-primary">Login</a>
					@endif
				</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
