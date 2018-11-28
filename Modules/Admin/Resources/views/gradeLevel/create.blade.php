@extends('admin::layouts.master')
@section('title')
    Create School
@endsection 
@section('content')
    <div class="content-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Trang chủ</a></li>
            <li class="breadcrumb-item active">Lớp</li>
        </ol>
        <form action="{{route('admin.grade.store')}}" method="post" class="validation-form">
            {{csrf_field()}}
            <section class="content">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Lớp</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>Tên Khối @include('common.require')</label>
                                    <div class="clearfix">
                                        <input type="text" class="form-control" name="name">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Tạo lớp</button>
                        <a href="{{route('admin.class.index')}}" type="button" class="btn btn-default">Quay trở lại</a>
                    </div>
                </div>
            </section>
        </form>
    </div>
@endsection

@push('scripts')
    {{--    <script src="{{ asset('assets/admin/plugins/iCheck/icheck.min.js') }}"></script>--}}
    <script src="{{ asset('modules/admin/class/class-validation.js')}}"></script>
    <script src="{{ asset('modules/admin/gradeLevel/gradeLevel.js') }}"></script>
@endpush