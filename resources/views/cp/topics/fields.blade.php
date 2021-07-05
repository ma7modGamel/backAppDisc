<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/topics.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- image Field -->
<div class="form-group col-sm-6">
    {!! Form::label('image', __('models/topics.fields.image').':') !!}
    <p><img width="200" height="200" src="{{ filter_var($topic->image, FILTER_VALIDATE_URL) ? $topic->image : url(Storage::url($topic->image)) }}"></p>
    {!! Form::file('image', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('cp.topics.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>