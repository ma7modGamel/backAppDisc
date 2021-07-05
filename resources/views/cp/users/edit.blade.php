@extends('cp.layouts.app')

@section('content')
<div class="content">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('libs/theme/plugins/select2/css/select2.min.css') }}">
    <script src="{{ asset('libs/theme/plugins/select2/js/select2.full.min.js') }}"></script>
    @include('common.errors')
    @include('flash::message')
    <div class="card card-primary">
        <div class="card-header">
            <ul class="nav nav-tabs" id="tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="tabs-user" data-toggle="pill" href="#user-tab" role="tab" aria-controls="user-tab" aria-selected="true">@lang('models/users.singular')</a>
                </li>

            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="tabsContent">
                <div class="tab-pane fade show active" id="user-tab" role="tabpanel" aria-labelledby="tabs-user">
                    <div class="row" style="padding-left: 20px">
                        {!! Form::model($user, ['route' => ['cp.users.update', $user->id], 'method' => 'patch']) !!}
                        <div class="row">
                            @include('cp.users.fields')
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(window).on('load',function () {
                $('.select2').select2()
            });
        </script>
    </div>
</div>
@endsection