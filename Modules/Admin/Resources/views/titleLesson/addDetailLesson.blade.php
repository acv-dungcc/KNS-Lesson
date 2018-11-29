<div class="modal fade" id="modalAddDetailLesson" role="dialog">
    <div class="modal-dialog">
        <form action="{{route('admin.titleLesson.storeLessonDetail')}}" method="post" class="validation-form">
        {{csrf_field()}}
        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Tạo tiêu đề nội dung</h4>
                </div>
                <div class="modal-body">
                    <label>Tên tiêu đề nội dung @include('common.require')</label>
                    <div class="clearfix">
                        <input type="text" class="form-control" name="detail-lesson" id="detail-lesson">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" data-dismiss="modal" id="create-detail-lesson">Tạo tiêu đề</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </form>
    </div>

</div>
</div>