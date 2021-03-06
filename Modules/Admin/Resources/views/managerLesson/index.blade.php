@extends('admin::layouts.master')
@section('title')
    Create Title Lesson
@endsection
@push('style')
    <link rel="stylesheet" href="{{asset('/modules/admin/managerContent/managerContent.css')}}">
@endpush
@section('content')
    <div class="content-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Trang chủ</a></li>
            <li class="breadcrumb-item active">Quản lý bài học</li>
        </ol>
        {{Session::get('success')}}
        <section class="content">
            <div class="clearfix">
                <button type="button" class="btn btn-primary  modal-show"
                        data-url="/admin/manager-lesson/add-lesson"
                >Tạo bài học
                </button>
            </div>
            <br>
            <div class="col-md-12">

                @include('common.message')

                <div class="col-md-8">
                    <h4>Danh sách bài học</h4>
                </div>
                <div class="col-md-4">
                    <select class="form-control" name="grade_id" id="nav-search-input">
                        <option value="">Chọn khối</option>
                        @foreach ($grades as $key => $grades)
                            <option value="{{$grades->id}}">{{$grades->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div style="clear: both"></div>
            <div id="changeLessonName" class="displayFull">
                @foreach($lessons as $lesson)
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h5 class="box-title" style="margin-right: 15px;">{{$lesson->stt}} Bài học {{$lesson->name}}</h5>

                            <button type="button" class="btn btn-info btn-sm modalDetailLesson modal-show"
                                    data-url="/admin/manager-lesson/get-value-lesson-detail/{{$lesson->id}}"
                                    data-value="{{$lesson->id}}" data-text="{{$lesson->name}}">Thêm nội
                                dung {{$lesson->name}}
                            </button>
                            <div class="box-tools pull-right">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.managerLesson.zip',$lesson->id) }}" class="btn btn-info test-object  "
                                       title=""
                                       is_public="{{$lesson->is_public}}"
                                       object_id="{{$lesson->id}}"
                                       object_name="{{$lesson->name}}">
                                        Thử nghiệm
                                    </a>
                                    <a href="#" class="btn btn-success is_public"  @if($lesson->is_public==1) style="opacity: 0.6;" @endif
                                       title="Public"
                                       is_public="{{$lesson->is_public}}"
                                       object_id="{{$lesson->id}}"
                                       object_name="{{$lesson->name}}">
                                       Public
                                    </a>

                                    <button type="button" class="btn btn-primary  modal-show"
                                            data-url="/admin/manager-lesson/edit-lesson/{{$lesson->id}}"
                                    ><i class="ace-icon fa fa-pencil"></i></button>
                                    <a href="#" class="btn btn-danger delete-lesson"
                                       title="Delete"
                                       object_id="{{$lesson->id}}"
                                       object_name="{{$lesson->name}}">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                </div>
                                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                            <table class="table table-hover results-table" >
                                <tr>
                                    <th class="order-number" style="width: 5px;">STT.</th>
                                    <th>Nội dung</th>
                                    <th class="item-action-3 pull-right">Status</th>
                                </tr>
                                <tbody class="sortable ui-sortable">
                                @if(!empty($lesson->lessonDetail))
                                    @foreach($lesson->lessonDetail as $key=>$lessonDetail)
                                        <tr data-id="{{$lessonDetail->id}}" class="order_lesson">
                                            <td class="">{{$key+1}}</td>
                                            <td>
                                            <span data-url="/admin/manager-lesson/get-value-type/{{$lessonDetail->id}}"
                                                  value="{{$lessonDetail->id}}"> {{$lessonDetail->title}}</span>

                                            </td>
                                            <td class="pull-right">
                                                <div class="btn-group btn-group-sm">
                                                    <button type="button" class="btn btn-primary  modal-show"
                                                            data-url="/admin/manager-lesson/edit-lesson-detail/{{$lessonDetail->id}}"
                                                    >Sửa nội dung
                                                    </button>

                                                    @if(!\App\Models\LessonContent::checkContentByDetailId($lessonDetail->id))
                                                        <button type="button" class="btn btn-success  modal-show"
                                                                data-url="/admin/manager-lesson/get-value-type/{{$lessonDetail->id}}">
                                                            Thêm chi tiết
                                                        </button>
                                                    @else
                                                        @foreach($lessonDetail->lessonContent as $key=>$item)
                                                            <button type="button" class="btn btn-success  modal-show"
                                                                    data-url="/admin/manager-lesson/edit-lesson-content/{{$item->id}}">
                                                                Sửa nội dung chi tiết
                                                            </button>
                                                        @endforeach
                                                    @endif

                                                    <a href="#" class="btn btn-danger delete-lesson-detail"
                                                       title="Delete"
                                                       object_id="{{$lessonDetail->id}}"
                                                       object_name="{{$lessonDetail->title}}">
                                                        <i class="fa fa-trash-o"></i>
                                                    </a>

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">Không có bản ghi nào</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>

            <div id="changeLessonName" class="displayLesson hidden">
                @foreach($lessons as $lesson)
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h5 class="box-title" style="margin-right: 15px;"> Bài học {{$lesson->name}}</h5>

                            <button type="button" class="btn btn-info btn-sm modalDetailLesson modal-show"
                                    data-url="/admin/manager-lesson/get-value-lesson-detail/{{$lesson->id}}"
                                    data-value="{{$lesson->id}}" data-text="{{$lesson->name}}">Thêm nội
                                dung {{$lesson->name}}</button>
                            <div class="box-tools pull-right">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.managerLesson.zip',$lesson->id) }}" class="btn btn-info test-object  "
                                       title=""
                                       is_public="{{$lesson->is_public}}"
                                       object_id="{{$lesson->id}}"
                                       object_name="{{$lesson->name}}">
                                        Thử nghiệm
                                    </a>
                                    <a href="#" class="btn btn-success is_public"  @if($lesson->is_public==1) style="opacity: 0.6;" @endif
                                    title="Public"
                                       is_public="{{$lesson->is_public}}"
                                       object_id="{{$lesson->id}}"
                                       object_name="{{$lesson->name}}">
                                        Public
                                    </a>

                                    <button type="button" class="btn btn-primary  modal-show"
                                            data-url="/admin/manager-lesson/edit-lesson/{{$lesson->id}}"
                                    ><i class="ace-icon fa fa-pencil"></i></button>
                                    <a href="#" class="btn btn-danger delete-lesson"
                                       title="Delete"
                                       object_id="{{$lesson->id}}"
                                       object_name="{{$lesson->name}}">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                </div>
                                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                            <table class="table table-hover results-table ">
                                <tbody>
                                <tr>
                                    <th class="order-number" style="width: 5px;">Id.</th>
                                    <th>Nội dung</th>
                                    <th class="item-action-3 pull-right">Status</th>
                                </tr>
                                @if(!empty($lesson->lessonDetail))
                                    @foreach($lesson->lessonDetail as $key=>$lessonDetail)
                                        <tr>
                                            <td class="">{{$key + 1}}</td>
                                            <td>
                                            <span data-url="/admin/manager-lesson/get-value-type/{{$lessonDetail->id}}"
                                                  value="{{$lessonDetail->id}}"> {{$lessonDetail->title}}</span>

                                            </td>
                                            <td class="pull-right">
                                                <div class="btn-group btn-group-sm">
                                                    <button type="button" class="btn btn-primary  modal-show"
                                                            data-url="/admin/manager-lesson/edit-lesson-detail/{{$lessonDetail->id}}"
                                                    >Sửa nội dung
                                                    </button>

                                                    @if(!\App\Models\LessonContent::checkContentByDetailId($lessonDetail->id))
                                                        <button type="button" class="btn btn-success  modal-show"
                                                                data-url="/admin/manager-lesson/get-value-type/{{$lessonDetail->id}}">
                                                            Thêm chi tiết
                                                        </button>
                                                    @else
                                                        @foreach($lessonDetail->lessonContent as $key=>$item)
                                                            <button type="button" class="btn btn-success  modal-show"
                                                                    data-url="/admin/manager-lesson/edit-lesson-content/{{$item->id}}">
                                                                Sửa nội dung chi tiết
                                                            </button>
                                                        @endforeach
                                                    @endif

                                                    <a href="#" class="btn btn-danger delete-object"
                                                       title="Delete"
                                                       object_id="{{$lessonDetail->id}}"
                                                       object_name="{{$lessonDetail->name}}">
                                                        <i class="fa fa-trash-o"></i>
                                                    </a>

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">Không có bản ghi nào</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>

        </section>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('modules/admin/managerContent/managerContent.js') }}"></script>

   <script>
       activeMenu('lesson','manager-lesson', true);
   </script>
    <script src="{{ asset('modules/admin/managerContent/lessonDelete.js') }}"></script>
    <script src="{{ asset('modules/admin/managerContent/lessonPublic.js') }}"></script>
    <script src="{{ asset('modules/admin/managerContent/lessonDetailDelete.js') }}"></script>
    <script src="{{ asset('common/pagination-search.js')}}"></script>
@endpush


