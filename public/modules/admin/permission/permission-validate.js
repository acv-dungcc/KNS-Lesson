
jQuery.validator.addMethod("VldHtml", function(value, element) {
    // allow any non-whitespace characters as the host part
    return this.optional( element ) || /<(.|\n)*?>/g.test( value )==true?false:true;
  }, 'Không được nhập kí tự đặc biệt');
  
$('.validation-form').validate({
    errorElement: 'div',
    errorClass: 'help-block',
    focusInvalid: false,
    ignore: "",
    rules: {
        name: {
            required: true,
            minlength: 3,
            VldHtml:true
        },
        display_name: {
            required: true,
            minlength: 3
        },
        type: {
            required: true
        }
    },

    messages: {
        name: {
             required: "Xin vui lòng nhập tên .",
            minlength: "Độ dài tối thiểu là 3"
        },
        display_name: {
             required: "Xin vui lòng nhập tên hiển thị .",
            minlength: "Độ dài tối thiểu là 3"
        },
        type: {
            required: "Please specify a short type."
        }
    },


    highlight: function (e) {
        // $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
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