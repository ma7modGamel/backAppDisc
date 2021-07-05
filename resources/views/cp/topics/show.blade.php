@extends('cp.layouts.app')

@section('content')
    <div class="content">
        <div class="card card-primary">
            <div class="card-header">
                <ul class="nav nav-tabs" id="tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="tabs-topic" data-toggle="pill" href="#topic-tab" role="tab" aria-controls="topic-tab" aria-selected="true">@lang('models/topics.singular')</a>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="tabsContent">
                    <div class="tab-pane fade show active" id="topic-tab" role="tabpanel" aria-labelledby="tabs-topic">
                        <div class="row" style="padding-left: 20px">
                            @include('cp.topics.show_fields')
                        </div>
                    </div>
                </div>
                <a href="{{ route('cp.topics.index') }}" class="btn btn-default">
                    @lang('crud.back')
                </a>
            </div>
        </div>
    </div>
@endsection
