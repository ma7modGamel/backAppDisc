@extends('cp.layouts.app')

@section('content')
<div class="content">
    @include('common.errors')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">@lang('models/topics.singular')</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

        <div class="card-body">
            {!! Form::open(['route' => 'cp.topics.store']) !!}
            <div class="row">

                <!-- Name Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('name', __('models/topics.fields.name').':') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>

                <!-- image Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('image', __('models/topics.fields.image').':') !!}
                    {!! Form::file('image', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <div class="card-footer">
            {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
            <a href="{{ route('cp.topics.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection