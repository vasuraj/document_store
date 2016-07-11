@extends('app')

@section('content')

<!-- base template -->
    <div class="container">
    <div class="row">
    <div class="col-md-12 ">
    <div class="panel panel-default">
    <div class="panel-heading" >Edit Profile</div>
    <div class="panel-body">





    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::open(array('url'=>'user/profileUpdate','method' => 'PATCH', 'files'=>true)) !!}
  
    

    {!! Form::text('id', $user->id, ['style'=>'height:0px; border:none; background:#fff; width:0px;overflow:hidden;','required'=>'required']) !!}
 


    <div class="form-group col-md-4">
        {!! Form::label('name', 'Name') !!}
        {!! Form::text('name',$user->name, ['class' => 'form-control','required'=>'required']) !!}
    </div>

    <div class="form-group col-md-4">
        {!! Form::label('email_disabled', 'Email') !!}
        {!! Form::text('email_disabled', $user->email, ['class' => 'form-control','required'=>'required','disabled'=>'disabled']) !!}
    </div>

  
    {!! Form::text('email', $user->email, ['required'=>'required','style'=>'height:0px; border:none; background:#fff; width:0px; overflow:hidden; margin:-5px;']) !!}
 


    <div class="form-group col-md-4">
        {!! Form::label('orgname', 'Organization\'s Name') !!}

        @if(isset($user_extra_info->orgname))
        {!! Form::text('orgname',$user_extra_info->orgname, ['class' => 'form-control','required'=>'required']) !!}
        @else
        {!! Form::text('orgname',null, ['class' => 'form-control','required'=>'required']) !!}
        @endif
    </div>
    <div class="form-group col-md-4">
        {!! Form::label('orgemail', 'Organization\'s Email') !!}

        @if(isset($user_extra_info->orgemail))
        {!! Form::email('orgemail',$user_extra_info->orgemail, ['class' => 'form-control','required'=>'required','type'=>'email']) !!}
        @else
        {!! Form::email('orgemail',null, ['class' => 'form-control','required'=>'required','type'=>'email']) !!}
        @endif
    </div>


    <div class="form-group col-md-4">
    <label for="mobile">Mobile Number (10 Digit)</label>
    <input type="tel" class="form-control" value="@if(isset($user_extra_info->mobile)){{$user_extra_info->mobile}}@endif" pattern="^\d{3}\d{3}\d{4}$" required name="mobile" id="mobile">
    </div>

    <div class="form-group col-md-4" >
    <label for="whatsapp_number">Whats App Number (10 Digit)</label>
    <input type="tel" required class="form-control" value="@if(isset($user_extra_info->whatsapp_number)){{$user_extra_info->whatsapp_number}}@endif" pattern="^\d{3}\d{3}\d{4}$" required  name="whatsapp_number" id="whatsapp_number">
    </div>

    <div class="form-group col-md-4" >
    <label for="skype_id">Skype ID</label>
    <input type="text" required class="form-control"value="@if(isset($user_extra_info->skype_id)){{$user_extra_info->skype_id}}@endif"  name="skype_id" id="skype_id">
    </div>
            
    <div class="form-group col-md-4" >
    <label for="landline_number">Landline Number (10 Digit)</label>
    <input type="tel" required class="form-control" value="@if(isset($user_extra_info->landline_number)){{$user_extra_info->landline_number}}@endif" pattern="^\d{3}\d{3}\d{4}$"   name="landline_number" id="landline_number">
    </div>

    <div class="form-group col-md-4" >
    <label for="address">Address</label>
    <input type="text" required class="form-control" value="@if(isset($user_extra_info->address)){{$user_extra_info->address}}@endif"   name="address" id="address">
    </div>


   
    <div class="form-group col-md-4">
        {!! Form::label('password', 'Password') !!}
        {!! Form::password('password', ['class' => 'form-control','id'=>'password','required'=>'required']) !!}
    </div>

    <div class="form-group col-md-4">
        {!! Form::label('password_confirmation', 'Confirm Password') !!}
        {!! Form::password('password_confirmation', ['class' => 'form-control','id'=>'confirm_password','required'=>'required']) !!}
    </div>

    <div class="form-group">
  
        @foreach($roles as $role)
            <?php $checked = in_array($role->id, $userRoles->lists('id')); ?>
          
                        {!! Form::checkbox('role[]', $role->id, $checked,['hidden'=>'hidden']) !!}
           
        @endforeach
    </div>

    <div class="form-group" style="float:right; margin-top:20px; margin-right:2%;">
        <!-- <a id="pre_submit" class="btn btn-primary">Update</a> -->
        {!! Form::submit('Update', ['class' => 'btn btn-primary', 'id'=>'final_submit_button']) !!}
        <!-- ,'style'=>"padding:0px; border:none; width:0px; overflow:hidden;" -->
    </div>

    {!! Form::close() !!}
   

   </div>
   </div>
   </div>
   </div>
   </div>
@stop

@section('body_end_section')
<script>
    
$("#pre_submit").click(function(){

   var password=$('#password').val();
   var confirm_password=$('#confirm_password').val();

   var is_empty=(password==='') ||(confirm_password==='') 
  

   if(!is_empty)
   {
    var is_confirm=(password===confirm_password);    
    if(!is_confirm)
       {
        alert('Password is not matching');
        
       }
       else
       {
        $('#final_submit_button').click();
       }
   }
   else
   {
    alert("Please enter a password")
   }
   

  
});


</script>
@endsection
