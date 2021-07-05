@extends('cp.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">@lang('models/users.plural')</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard v1</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
            <div class="col-12">
                <div class="clearfix"></div>

                @include('flash::message')

                <div class="clearfix"></div>

                <div class="card">
                    <div class="card-header">
                        <div class="float-right">
                            <h1>
                                <a class="btn btn-primary float-right"
                                    href="{{ route('cp.users.create') }}">@lang('crud.add_new')</a>
                            </h1>
                        </div>

                        <h3 class="card-title">@include('common.perpage')</h3>
                        <div class="mx-auto w-50 card-tools">
                            <div class="input-group input-group-sm" style="width: 200px;">
                                <input type="text" name="table_search" class="form-control float-right"
                                    placeholder="Search">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    @include('cp.users.table')

                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-right">
                            @include('common.paginate', ['records' => $users])
                        </ul>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>




@endsection