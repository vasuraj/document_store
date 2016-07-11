@extends('app')

@section('content')
    <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Users</div>       


    <div class="panel">     
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

    {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'PATCH']) !!}

    <div class="form-group">
        {!! Form::label('name', 'Name') !!}
        {!! Form::text('name', null, ['class' => 'form-control','required'=>'required']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('email', 'Email') !!}
        {!! Form::text('email', null, ['class' => 'form-control','required'=>'required']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('password', 'Password') !!}
        {!! Form::password('password', ['class' => 'form-control','required'=>'required']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('password_confirmation', 'Password confirmation') !!}
        {!! Form::password('password_confirmation', ['class' => 'form-control','required'=>'required']) !!}
    </div>

    <div class="form-group">
        Roles
        @foreach($roles as $role)
            @if($role->display_name!='Editor')
            <?php $checked = in_array($role->id, $userRoles->lists('id')); ?>
                <div class="checkbox">
                    <label>
                        {!! Form::checkbox('role[]', $role->id, $checked) !!} {{ $role->display_name }}
                    </label>
                </div>
            @endif
        @endforeach
    </div>

    <div class="form-group">
        {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}


</div>
</div>
</div>
</div>
</div>
</div>
@stop