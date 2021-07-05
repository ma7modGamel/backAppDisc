@extends('cp.layouts.app')

@section('content')
    <div class="content">
        <div class="card card-primary">
            <div class="card-header">
                <ul class="nav nav-tabs" id="tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="tabs-user" data-toggle="pill" href="#user-tab" role="tab" aria-controls="user-tab" aria-selected="true">@lang('models/users.singular')</a>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="tabsContent">
                    <div class="tab-pane fade show active" id="user-tab" role="tabpanel" aria-labelledby="tabs-user">
                        <div class="row" style="padding-left: 20px">
                            @include('cp.users.show_fields')
                        </div>
                    </div>
                </div>
                <a href="{{ route('cp.users.index') }}" class="btn btn-default">
                    @lang('crud.back')
                </a>
            </div>
        </div>
    </div>
@endsection
