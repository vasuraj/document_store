@extends('app')

@section('content')

    <div class="page-options">
                <div colspan="2"><a href="{{ URL::route('users.create') }}" class="btn btn-primary btn-block">Create</a></div>
                <div width="80"><a id="edit_button" style="display:none;" class="btn btn-primary" href="#">Edit</a></div>
                <div width="80">{!! Form::open(['route' => ['users.update',""], 'method' => 'DELETE','id'=>"delete_button_form", "style"=>"display:none;" ]) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger ', 'onclick' => 'return confirm("Are you sure?");']) !!}
                    {!!  Form::close() !!}
                </div>

    </div>

    <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Users</div>       


    <div class="panel">     
    <div class="panel-body">

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Role</th>
        
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }} 

                    <input class="select_one_radio" value ="{{ $user->id }}" type="radio" name="selected_user_id"/>
                </td>
                <td>{{ $user->email }}</td>
                <td>
                    @foreach($user->roles as $role)
                        <span class="label label-info">{{ $role->name }}</span>
                    @endforeach

                </td>
               

                <!--    <td width="80"><a class="btn btn-primary" href="{{ URL::route('users.edit', $user->id) }}">Edit</a></td>
                <td width="80">{!! Form::open(['route' => ['users.update', $user->id], 'method' => 'DELETE']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' => 'return confirm("Are you sure?");']) !!}
                    {!!  Form::close() !!}
                </td> -->
                </tr>


            
        @endforeach
        </tbody>
    </table>

    {!! $users->render() !!}
</div>
</div>
</div>
</div>
</div>
</div>

@stop

@section('body_end_section')
<script>
    
$(".select_one_radio").click(function(){

var selected_id=$(this).val();

$("#edit_button").css("display","block").attr('href','{{URL::to("users")}}/'+selected_id+'/edit');
$("#delete_button_form").css("display","block").attr('action','{{URL::to("users")}}/'+selected_id);  
});

</script>

@endsection

<!--    <td width="80"><a class="btn btn-primary" href="{{ URL::route('users.edit', $user->id) }}">Edit</a></td>
                <td width="80">{!! Form::open(['route' => ['users.update', $user->id], 'method' => 'DELETE']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' => 'return confirm("Are you sure?");']) !!}
                    {!!  Form::close() !!}</td>

    http://localhost/document_store/public/users -->