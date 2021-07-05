<!-- Name Field -->
<div class="form-group col-sm-4">
    {!! Form::label('name', __('models/users.fields.name').':') !!}
    <p>{{ $user->name }}</p>
</div>

<!-- Email Field -->
<div class="form-group col-sm-4">
    {!! Form::label('email', __('models/users.fields.email').':') !!}
    <p>{{ $user->email }}</p>
</div>

<!-- is_admin Field -->
<div class="form-group col-sm-4">
    {!! Form::label('is_admin', __('models/users.fields.is_admin').':') !!}
    <p>
        @if($user->is_admin)
            <i class="fa fa-2x fa-check-circle"></i>
        @else
            <i class="fa fa-2x fa-times-circle"></i>
        @endif    
    </p>
    
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/users.fields.created_at').':') !!}
    <p>{{ $user->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/users.fields.updated_at').':') !!}
    <p>{{ $user->updated_at }}</p>
</div>

