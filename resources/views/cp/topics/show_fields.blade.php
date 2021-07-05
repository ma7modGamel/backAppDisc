<!-- Name Field -->
<div class="form-group col-sm-4">
    {!! Form::label('name', __('models/topics.fields.name').':') !!}
    <p>{{ $topic->name }}</p>
</div>

<!-- image Field -->
<div class="form-group col-sm-4">
    {!! Form::label('image', __('models/topics.fields.image').':') !!}
    <p><img width="200" height="200" src="{{ filter_var($topic->image, FILTER_VALIDATE_URL) ? $topic->image : url(Storage::url($topic->image)) }}"></p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/topics.fields.created_at').':') !!}
    <p>{{ $topic->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/topics.fields.updated_at').':') !!}
    <p>{{ $topic->updated_at }}</p>
</div>

