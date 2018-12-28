   var id= $('#id').val();
$('.validation-form').validate({
    errorElement: 'div',
    errorClass: 'help-block',
    focusInvalid: false,
    ignore: "",
    rules: {
        name: {
            remote:"/admin/manager-area/checkNameDistrict/"+id,
            required: true,
               
        },
        area_id:{
             required: true,
        },
        province_id:{
            required: true,
        },

    },

    messages: {
        name: {
            remote: "Tên đã tồn tại",
            required: "Xin vui lòng nhập tên.",
        },
         area_id:{
             required: "Xin vui lòng chọn khu  vực.",
        },
          province_id:{
            required: "Xin vui lòng chọn tỉnh/thành phố.",
        },

    },


    highlight: function (e) {
        $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
    },

    success: function (e) {
    $(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
    $(e).remove();
    },

    errorPlacement: function (error, element) {
    if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
        var controls = element.closest('div[class*="col-"]');
        if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
        else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
    }
    else if(element.is('.select2')) {
        error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
    }
    else if(element.is('.chosen-select')) {
        error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
    }
    else error.insertAfter(element.parent());
    }
});