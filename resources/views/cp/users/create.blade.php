@extends('cp.layouts.app')

@section('content')
<div class="content">
    @include('common.errors')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">@lang('models/users.singular')</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

        <div class="card-body">
            {!! Form::open(['route' => 'cp.users.store']) !!}
            <div class="row">

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

                <!-- Confirm Password Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('password_confirmation', __('models/users.fields.password_confirmation').':') !!}
                    {!! Form::input('password','password_confirmation', null, ['class' => 'form-control']) !!}
                </div>

                <!-- is_admin Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('is_admin', __('models/users.fields.is_admin').':') !!}
                    <label class="checkbox-inline">
                        {!! Form::hidden('is_admin', 0) !!}
                        {!! Form::checkbox('is_admin', '1', null) !!}
                    </label>
                </div>

            </div>
            <!-- /.card-body -->
        </div>
        <div class="card-footer">
            {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
            <a href="{{ route('cp.users.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection