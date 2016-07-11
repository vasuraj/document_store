@extends('app')

@section('page_title')
Profile
@endsection

@section('head_section')
<style>
  
  body, html
  {
    height:100%;

  }
</style>
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12" style="height:100%;">
    <div class="panel panel-default">
  <div class="panel-heading">Profile 
  <a class="btn btn-xs btn-primary" href="{{URL::to('/user/profile')}}/{{$user_id}}/edit" style="float:right">Edit</a>
  </div>
  </div>

  <div class="panel" style="margin-top:-21px; border-radius:0px 0px 3px 3px;">
 
        <div class="panel-body" >
     
        <table class="table table-striped">
          <tr>
            <td>Name</td>
            <td>{{$user_basic_info->name}}</td>
          </tr>
          <tr>
            <td>Email</td>
            <td>{{$user_basic_info->email}}</td>
          </tr>
          <tr>
        @if(isset($user_basic_info) && isset($user_extra_info))  
            <td>Organisation </td>
            <td>{{$user_extra_info->orgname}}</td>
          </tr>
          <tr>
            <td>Offical email</td>
            <td>{{$user_extra_info->orgemail}}</td>
          </tr>
          <tr>
            <td>Mobile Number</td>
            <td>{{$user_extra_info->mobile}}</td>
          </tr>
          <tr>
            <td>WhatsApp Number</td>
            <td>{{$user_extra_info->whatsapp_number}}</td>
          </tr>
          <tr>
            <td>Skype ID</td>
            <td>{{$user_extra_info->skype_id}}</td>
          </tr>
          <tr>
            <td>Landline Number</td>
            <td>{{$user_extra_info->landline_number}}</td>
          </tr>
          <tr>
            <td>Address</td>
            <td>{{$user_extra_info->address}}</td>
          </tr>
  @else
 <!--  <div style="text-align:center; padding:10px;">
  <span style="background:#e3e3e3; box-shadow:0px 1px 2px gray; padding:5px 10px; margin:10px;">No Other information</span>
  </div> -->
  @endif
        </table>
        </div>

    </div>

</div>


			</div>

		</div>
	</div>
</div>

@endsection

@section('body_end_section')

<script>
  
$(function(){
    $("#abbreviation").change(function(){

    var abbreviation=$(this).find(':selected').val();
    var deadline=$(this).find(':selected').attr('data-deadline');
    if(abbreviation!="none")
    {
        $.get("{{url('/fileUpload/deadline')}}", function(data){
          // alert("Data: " + data);

        $("iframe").attr('src',"{{url('/fileUpload/getdeadline')}}/"+abbreviation+'/'+deadline);

        });
    }
    else
    {
        $("iframe").attr('src','');

    }


    // Dynamic iframe height 

   setInterval(function(){
      document.getElementById("Iframe").style.height = document.getElementById("Iframe").contentWindow.document.body.scrollHeight-20 + 'px';
  },0)


    });




});



</script>
@endsection
