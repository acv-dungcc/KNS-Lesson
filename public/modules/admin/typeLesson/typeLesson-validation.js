   var id= $('#type-id').val();
$('.validation-form').validate({
    errorElement: 'div',
    errorClass: 'help-block',
    focusInvalid: false,
    ignore: "",
    rules: {
        name: {
            remote:"/admin/type-lesson/checkName/"+id,
            required: true,
               
        },
        id_type:{

            remote:"/admin/type-lesson/checkId/"+id,

        }
         

    },

    messages: {
        name: {
            remote: "Tên đã tồn tại",
            required: "Xin vui lòng nhập tên .",
        },
        id_type:{
             remote: "Id đã tồn tại",
        }
       

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