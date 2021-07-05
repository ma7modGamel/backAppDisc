<div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <thead>
            <tr>
                <th>@lang('models/users.fields.name')</th>
                <th>@lang('models/users.fields.email')</th>
                <th>@lang('models/users.fields.is_admin')</th>
                <th colspan="3">@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if($user->is_admin)
                        <i class="fa fa-2x fa-check-circle"></i>
                    @else
                        <i class="fa fa-2x fa-times-circle"></i>
                    @endif
                </td>
                <td>
                    {!! Form::open(['route' => ['cp.users.destroy', $user->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('cp.users.show', [$user->id]) }}" class='btn btn-default btn-xs'><i class="far fa-eye"></i></a>
                        <a href="{{ route('cp.users.edit', [$user->id]) }}" class='btn btn-default btn-xs'><i class="far fa-edit"></i></a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>