<div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <thead>
            <tr>
                <th>@lang('models/topics.fields.name')</th>
                <th>@lang('models/topics.fields.image')</th>
                <th colspan="3">@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td><img width="200" height="200" src="{{ filter_var($item->image, FILTER_VALIDATE_URL) ? $item->image : url(Storage::url($item->image)) }}"></td>
                <td>
                    {!! Form::open(['route' => ['cp.topics.destroy', $item->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('cp.topics.show', [$item->id]) }}" class='btn btn-default btn-xs'><i class="far fa-eye"></i></a>
                        <a href="{{ route('cp.topics.edit', [$item->id]) }}" class='btn btn-default btn-xs'><i class="far fa-edit"></i></a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>