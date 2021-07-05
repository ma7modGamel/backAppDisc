<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/users.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', __('models/users.fields.email').':') !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', __('models/users.fields.password').':') !!}
    {!! Form::input('password','password', null, ['class' => 'form-control']) !!}
</div>

<!-- is_admin Field -->
<div class="form-group col-sm-6">
    {!! Form::label('is_admin', __('models/users.fields.is_admin').':') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('is_admin', 0) !!}
        {!! Form::checkbox('is_admin', '1', null) !!}
    </label>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('cp.users.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>