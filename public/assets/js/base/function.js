/**
 * @descreption: Tổng hợp các hàm sửa dụng
 *
 */

/*==================================*/

/**
 * Hàm xử lý sự kiện sau khi click vào link ajax trả kết quả về
 * @param {Object} data Dữ liệu trả về
 * @param {jQuery} obj Link click vào
 * @returns {undefined}
 */
function default_ajax_link(data, obj) {
    if (data.state == 1) {
        if (data.html) {
            var $modal = $("<div class='modal fade e_modal_content'>");
            $modal.html(data.html);
            $modal.modal({
                backdrop: 'static',
            });
        }
    } else {
        if (data.redirect) {
            window.location = data.redirect;
        }
    }
}


function permission_error(data, obj) {
    if (data.state != undefined && data.state == 0) {
        $.jGrowl("<i class='icon16 i-checkmark-3'></i> " + data.msg, {
            group        : "alert-danger",
            position     : 'top-right',
            sticky       : false,
            closeTemplate: '<i class="fa fa-times" aria-hidden="true"></i>',
            animateOpen  : {
                width : 'show',
                height: 'show'
            }
        });
    }
}

function default_data_table(data, obj) {
    if (data.state != undefined && data.state == 0) {
        $.jGrowl("<i class='icon16 i-checkmark-3'></i> " + data.msg, {
            group        : "alert-danger",
            position     : 'top-right',
            sticky       : false,
            closeTemplate: '<i class="fa fa-times" aria-hidden="true"></i>',
            animateOpen  : {
                width : 'show',
                height: 'show'
            }
        });
    } else {
        obj.find(".e_data_table").html(data.html);
        obj.find(".e_data_table select").select2();
    }
}

/**
 * Hàm sử lý sự kiện sau khi lưu form edit
 * @param {Object} data Dữ liệu trả về
 * @param {jQuery} form Form xảy ra sự kiện
 * @param {jQuery} button   Button xảy ra sự kiện
 * @returns {undefined}
 */
function save_form_edit_response(data, form, button) {
    button.removeAttr('disabled');
    var jgrow = "alert-danger";
    if (data.state == 1) { /* Thành công */
        button.removeClass('btn-danger');
        button.addClass('btn-success');
        button.html('Thành công ...');
        jgrow = "alert-success";

        var for_key = data.key_name;
        $("th[field_name]").each(function () {
            var attr = $(this).attr("field_name").split(".");
            if (attr[attr.length - 1] == data.key_name) {
                for_key = $(this).attr("field_name");
            }
        });
        var tempObj = $("tr[data-id='" + data.record[data.key_name] + "']");
        if (tempObj && tempObj.length) {
            tempObj.find("td").effect("highlight", {}, 5000);
            for (var key in data.record) {
                tempObj.children("td[for_key]").each(function () {
                    var t_key = $(this).attr("for_key");
                    if (t_key == key) {
                        $(this).html(data.record[key]);
                    } else {
                        if (t_key.split(".").length > 1) {
                            if (t_key.split(".")[1] == key) {
                                $(this).html(data.record[key]);
                            }
                        }
                    }
                });
            }
        }
        form.parents(".e_modal_content").modal("hide");
    } else if (data.state == 0) { /* Lỗi dữ liệu không hợp lệ */
        button.addClass('btn-danger');
        button.removeClass('btn-success');
        button.html('Thất bại ...');
    } else if (data.state == 2) { /* Lỗi phía server */
        button.addClass('btn-danger');
        button.removeClass('btn-success');
        button.html('Thất bại ...');
    } else {
        button.addClass('btn-danger');
        button.removeClass('btn-success');
        button.html('Không rõ kết quả');
    }
    if (data.error) {
        show_error(data.error, form);
    }

    if (data.hasOwnProperty("redirect")) {
        setTimeout(function () {
            window.location = data.redirect;
        }, 3000);

    }

    if (data.hasOwnProperty("reload")) {
        setTimeout(function () {
            window.location.reload();
        }, 3000);
    }

    $.jGrowl("<i class='icon16 i-checkmark-3'></i> " + data.msg, {
        group        : jgrow,
        position     : 'top-right',
        sticky       : false,
        closeTemplate: '<i class="fa fa-times" aria-hidden="true"></i>',
        animateOpen  : {
            width : 'show',
            height: 'show'
        }
    });
}


/**
 * Hàm sử lý sự kiện sau khi lưu form add
 * @param {Object} data Dữ liệu trả về
 * @param {jQuery} form Form xảy ra sự kiện
 * @param {jQuery} button   Button xảy ra sự kiện
 * @returns {undefined}
 */
function save_form_add_response(data, form, button) {
    button.removeAttr('disabled');
    var jgrow = "alert-danger";
    if (data.state == 1) { /* Thành công */
        button.removeClass('btn-danger');
        button.addClass('btn-success');
        button.html('Thành công ...');
        jgrow = "alert-success";

        var tempObj = $(".e_manager_table_container");
        //TODO : WARNING dùng để fix khi page có nhiều hơn 1 bảng
        if (tempObj.length > 1) {
            location.reload();
        }
        if (tempObj) {
            creat_ajax_table(tempObj);
        }

        form.parents(".e_modal_content").modal("hide");
    } else if (data.state == 0) { /* Lỗi dữ liệu không hợp lệ */
        button.addClass('btn-danger');
        button.removeClass('btn-success');
        button.html('Thất bại ...');
    } else if (data.state == 2) { /* Lỗi phía server */
        button.addClass('btn-danger');
        button.removeClass('btn-success');
        button.html('Thất bại ...');
        location.reload();
    } else {
        button.addClass('btn-danger');
        button.removeClass('btn-success');
        button.html('Không rõ kết quả');
        location.reload();
    }
    if (data.error) {
        show_error(data.error, form);
    }

    $.jGrowl("<i class='icon16 i-checkmark-3'></i> " + data.msg, {
        group        : jgrow,
        position     : 'top-right',
        sticky       : false,
        closeTemplate: '<i class="fa fa-times" aria-hidden="true"></i>',
        animateOpen  : {
            width : 'show',
            height: 'show'
        }
    });
}


/**
 * Hàm xử lý dữ liệu trả về khi gọi form add
 * @param {object}  data    dữ liệu trả về dạng json.
 * @param {jQuery}  obj     Đối tượng click vào (đối tượng phát sinh ajax)
 * @returns {undefined}
 */
function get_form_add_response(data, obj) {
    if (data.state == 1) {
        if (data.html) {
            var $modal = $("<div class='modal fade e_modal_content'>");
            $modal.html(data.html);
            $modal.find("button:not(.b_add)").remove();
            var selector = creat_input_selector("[alias_for]");
            $modal.find(selector).each(function () {
                var aliasObj = $(this);
                selector = creat_input_selector("[name='" + aliasObj.attr("alias_for") + "']");
                var sourceObj = $modal.find(selector);
                if (sourceObj && sourceObj.length) {
                    sourceObj.on("keyup", function () {
                        aliasObj.val(make_alias(sourceObj.val()));
                    });
                }
                aliasObj.on("change", function () {
                    aliasObj.val(make_alias(aliasObj.val()));
                });
            });
            $modal.modal({
                backdrop: 'static',
            });
        }
    } else {
        if (data.redirect) {
            window.location = data.redirect;
        }
    }
}

/**
 * Hàm xử lý dữ liệu trả về khi gọi form edit
 * @param {object}  data    dữ liệu trả về dạng json.
 * @param {jQuery}  obj     Đối tượng click vào (đối tượng phát sinh ajax)
 * @returns {undefined}
 */
function get_form_edit_response(data, obj) {
    if (data.state != "1") {
        $.jGrowl("<i class='icon16 i-checkmark-3'></i> " + data.msg, {
            group        : "alert-danger",
            position     : 'top-right',
            sticky       : false,
            closeTemplate: '<i class="fa fa-times" aria-hidden="true"></i>',
            animateOpen  : {
                width : 'show',
                height: 'show'
            }
        });
    } else {
        if (!data.record_data) {
            $.jGrowl("<i class='icon16 i-checkmark-3'></i> Id không tồn tại", {
                group        : "alert-danger",
                position     : 'top-right',
                sticky       : false,
                closeTemplate: '<i class="fa fa-times" aria-hidden="true"></i>',
                animateOpen  : {
                    width : 'show',
                    height: 'show'
                }
            });
        }
        if (data.html) {
            var $modal = $("<div class='modal fade e_modal_content'>");
            $modal.html(data.html);
            $modal.find("button:not(.b_edit)").remove();
            $modal.modal({
                backdrop: 'static',
            });
        }
    }
}


/**
 * Hàm xử lý dữ liệu trả về khi gọi form view
 * @param {object}  data    dữ liệu trả về dạng json.
 * @param {jQuery}  obj     Đối tượng click vào (đối tượng phát sinh ajax)
 * @returns {undefined}
 */
function get_data_view_response(data, obj) {
    if (data.state != 1) {
        $.jGrowl("<i class='icon16 i-checkmark-3'></i> " + data.msg, {
            group        : "alert-danger",
            position     : 'top-right',
            sticky       : false,
            closeTemplate: '<i class="fa fa-times" aria-hidden="true"></i>',
            animateOpen  : {
                width : 'show',
                height: 'show'
            }
        });
    } else {
        if (!data.record_data) {
            $.jGrowl("<i class='icon16 i-checkmark-3'></i> Id không tồn tại", {
                group        : "alert-danger",
                position     : 'top-right',
                sticky       : false,
                closeTemplate: '<i class="fa fa-times" aria-hidden="true"></i>',
                animateOpen  : {
                    width : 'show',
                    height: 'show'
                }
            });
        }
        if (data.html) {
            var $modal = $("<div class='modal fade e_modal_content'>");
            $modal.html(data.html);
            for (var key in data.record_data) {
                var tempSelector = creat_input_selector("[name='" + key + "']");
                var inputObj = $modal.find(tempSelector).attr("disabled", "disabled");
                if (inputObj.attr("type") == "checkbox") {
                    inputObj.prop("checked", data.record_data[key] == 1 ? true : false);
                } else {
                    inputObj.val(data.record_data[key]);
                }
            }
            $modal.find("button:not(.b_view)").remove();
            $modal.modal({
                keyboard: true,
                backdrop: true
            });

        }
    }
}

function action_response(data, obj) {
    var group = "alert-success";
    if (data.state != 1) {
        group = "alert-danger";
    }
    $.jGrowl("<i class='icon16 i-checkmark-3'></i> " + data.msg, {
        group        : group,
        position     : 'top-right',
        sticky       : false,
        closeTemplate: '<i class="fa fa-times" aria-hidden="true"></i>',
        animateOpen  : {
            width : 'show',
            height: 'show'
        }
    });
}


function delete_respone(data, obj) {
    var group = "alert-success";

    if (data.state != 1) {
        group = "alert-danger";
    } else {
        for (var key in data.list_id) {
            obj.parents(".e_widget").find(".e_data_table table tbody tr[data-id='" + data.list_id[key] + "']").fadeOut(1000, function () {
                $(this).remove();
            });
        }
    }

    $.jGrowl("<i class='icon16 i-checkmark-3'></i> " + data.msg, {
        group        : group,
        position     : 'top-right',
        sticky       : false,
        closeTemplate: '<i class="fa fa-times" aria-hidden="true"></i>',
        animateOpen  : {
            width : 'show',
            height: 'show'
        }
    });
}


/**
 * Hàm xử lý mặc định dữ liệu trả về khi submit form
 * @param {object} data
 * @param {jQuery} form
 * @param {jQuery} button
 * @returns {undefined}
 */
function default_form_submit_respone(data, form, button) {
    button.removeAttr('disabled');
    var jgrow = "alert-danger";
    if (data.state == 1) { /* Thành công */
        button.removeClass('btn-danger');
        button.addClass('btn-success');
        button.html('Thành công ...');
        jgrow = "alert-success";
    } else if (data.state == 0) { /* Lỗi dữ liệu không hợp lệ */
        button.addClass('btn-danger');
        button.removeClass('btn-success');
        button.html('Thất bại ...');
    } else if (data.state == 2) { /* Lỗi phía server */
        button.addClass('btn-danger');
        button.removeClass('btn-success');
        button.html('Thất bại ...');
    } else {
        button.addClass('btn-danger');
        button.removeClass('btn-success');
        button.html('Không rõ kết quả');
    }
    if (data.error) {
        show_error(data.error);
    }

    $.jGrowl(data.msg, {
        group        : jgrow,
        position     : 'top-right',
        sticky       : false,
        closeTemplate: '<i class="fa fa-times" aria-hidden="true"></i>',
        animateOpen  : {
            width : 'show',
            height: 'show'
        },
        afterOpen    : function () {
            if (data.redirect) {
                window.location = data.redirect;
            }
        }
    });
}

/**
 *
 * @param {object} errorList Danh sách các lỗi, dạng objetc {key:value}<br/>
 *                       key là name của form, value là text hiển thị lỗi
 * @returns {undefined}
 */
function show_error(errorList, form) {
    var selector = creat_input_selector("");
    form.find(selector).each(function () {
        var name = $(this).attr("name");
        name = name.replace("[]", "");
        if (errorList.hasOwnProperty(name)) {
            var parent = $(this).closest(".form-group");
            change_error_state($(this), false);
            parent.find("label.help-block").html(errorList[name]);
        } else {
            change_error_state($(this), true);
        }
    });
}


/**
 * Hàm thay đổi hiển thị lỗi của các input trong form
 * @param {jQuery} obj
 * @param {bool} is_valid
 * @returns change View
 */
function change_error_state(obj, is_valid) {
    var parent = obj.closest(".form-group");
    if (is_valid) {
        parent.removeClass("has-error");
        parent.addClass("has-success");
        parent.find("label.help-block").hide();
    } else {
        parent.removeClass("has-success");
        parent.addClass("has-error");
        var error = parent.find("label.help-block"); //length;//.children(".error");
        if (error.length) {
            error.show();
        } else {
            parent.append("<label class='help-block col-sm-8 col-xs-12 col-sm-offset-3'></label>").show();
        }
    }
}


/**
 * Hàm kiểm tra email có hợp lệ hay không
 * @param {String} email
 * @returns {boolean}
 */
function is_email(email) {
    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    return pattern.test(email);
}


function creat_input_selector(more) {
    var input = "input,select,radio,textarea";
    var temp = input.split(",");
    var selector = "";
    if (more.substr(more.length - 1) != ",") {
        selector = temp.join(more + ",") + more;
    } else {
        selector = temp.join(more) + more.slice(0, more.length - 1);
    }
    return selector;
}

function change_view_form() {
    var input = creat_input_selector("[js_default_value]");
    $(input).each(function () {
        var self = $(this);
        self.val(self.attr("js_default_value"));
    });
    $('#input-upload-file').ace_file_input({
        style        : 'well',
        btn_choose   : 'Drop files here or click to choose',
        btn_change   : null,
        no_icon      : 'ace-icon fa fa-cloud-upload',
        droppable    : false,// to upload automatic when submit form
        thumbnail    : 'small'//large | fit
        //,icon_remove:null//set null, to hide remove/reset button
        /**,before_change:function(files, dropped) {
                         //Check an example below
                         //or examples/file-upload.html
                         return true;
                         }*/
        /**,before_remove : function() {
                         return true;
                         }*/
        ,
        preview_error: function (filename, error_code) {
            console.log(thumbnail);
            //name of the file that failed
            //error_code values
            //1 = 'FILE_LOAD_FAILED',
            //2 = 'IMAGE_LOAD_FAILED',
            //3 = 'THUMBNAIL_FAILED'
            //alert(error_code);
        }

    }).on('change', function () {
        // console.log($(this).data('ace_file_input'));
        //console.log($(this).data('ace_input_files'));
        //console.log($(this).data('ace_input_method'));
    });


    //dynamically change allowed formats by changing allowExt && allowMime function
    $('#id-file-format').removeAttr('checked').on('change', function () {
        var whitelist_ext, whitelist_mime;
        var btn_choose
        var no_icon
        if (this.checked) {
            btn_choose = "Drop images here or click to choose";
            no_icon = "ace-icon fa fa-picture-o";

            whitelist_ext = ["jpeg", "jpg", "png", "gif", "bmp"];
            whitelist_mime = ["image/jpg", "image/jpeg", "image/png", "image/gif", "image/bmp"];
        }
        else {
            btn_choose = "Drop files here or click to choose";
            no_icon = "ace-icon fa fa-cloud-upload";

            whitelist_ext = null;//all extensions are acceptable
            whitelist_mime = null;//all mimes are acceptable
        }
        var file_input = $('#input-upload-file');
        file_input
            .ace_file_input('update_settings',
                {
                    'btn_choose': btn_choose,
                    'no_icon'   : no_icon,
                    'allowExt'  : whitelist_ext,
                    'allowMime' : whitelist_mime
                })
        file_input.ace_file_input('reset_input');

        file_input
            .off('file.error.ace')
            .on('file.error.ace', function (e, info) {
                //console.log(info.file_count);//number of selected files
                //console.log(info.invalid_count);//number of invalid files
                //console.log(info.error_list);//a list of errors in the following format

                //info.error_count['ext']
                //info.error_count['mime']
                //info.error_count['size']

                //info.error_list['ext']  = [list of file names with invalid extension]
                //info.error_list['mime'] = [list of file names with invalid mimetype]
                //info.error_list['size'] = [list of file names with invalid size]


                /**
                 if( !info.dropped ) {
                             //perhapse reset file field if files have been selected, and there are invalid files among them
                             //when files are dropped, only valid files will be added to our file array
                             e.preventDefault();//it will rest input
                             }
                 */


                //if files have been selected (not dropped), you can choose to reset input
                //because browser keeps all selected files anyway and this cannot be changed
                //we can only reset file field to become empty again
                //on any case you still should check files with your server side script
                //because any arbitrary file can be uploaded by user and it's not safe to rely on browser-side measures
            });

    });
    $('#input-upload-img').ace_file_input({
        style        : 'well',
        btn_choose   : 'Drop files here or click to choose',
        btn_change   : null,
        no_icon      : 'ace-icon fa fa-picture-o',
        allow_ext    : ["jpeg", "jpg", "png", "gif", "bmp"],
        allow_mine   : ["image/jpg", "image/jpeg", "image/png", "image/gif", "image/bmp"],
        droppable    : false,// to upload automatic when submit form
        thumbnail    : 'small'//large | fit
        //,icon_remove:null//set null, to hide remove/reset button
        /**,before_change:function(files, dropped) {
                         //Check an example below
                         //or examples/file-upload.html
                         return true;
                         }*/
        /**,before_remove : function() {
                         return true;
                         }*/
        ,
        preview_error: function (filename, error_code) {
            console.log(thumbnail);
            //name of the file that failed
            //error_code values
            //1 = 'FILE_LOAD_FAILED',
            //2 = 'IMAGE_LOAD_FAILED',
            //3 = 'THUMBNAIL_FAILED'
            //alert(error_code);
        }

    }).on('change', function () {
        // console.log($(this).data('ace_file_input'));
        //console.log($(this).data('ace_input_files'));
        //console.log($(this).data('ace_input_method'));
    });
    $(".resizable").resizable({handles: "e, w"});
    $(".form-horizontal").find("select.select2").select2();
    $('.select2').addClass('tag-input-style');

    $("input[type='number'][number_format]").each(function () {
        show_number_format(false, $(this));
    });
    $(".form-horizontal").find("[type='datepicker']").datepicker({format: 'dd-mm-yyyy'});
    $(".form-horizontal").find("[type='checkbox']").removeClass("width-100").addClass('ace').after("<label class='lbl'></label>");
    $(".form-horizontal").find("[type='datetimepicker']").datepicker({format: 'dd-mm-yyyy'});
    build_file_input();
    build_editor();
}

function build_file_input() {
    $("input.ace_file_input").each(function () {
        var self = $(this);
        var allow_ext = null;
        var max_size = false;
        if (!self.data("disable_client_validate")) {
            allow_ext = self.data("allowed_types");
            max_size = self.data("max_size");
        }

        var has_error = false;
        self.ace_file_input({
            style        : 'well',
            btn_choose   : 'Drop files here or click to choose',
            btn_change   : null,
            no_icon      : 'ace-icon fa fa-cloud-upload',
            droppable    : true,
            thumbnail    : 'small',//small | large | fit
            allowExt     : allow_ext,
            maxSize      : max_size,
            before_change: function (file_list, droped) {
                if (!has_error) {
                    self.closest(".form-group").find("label.help-block").hide();
                }
                return file_list;
            },

        }).on('change', function () {
            //console.log($(this).data('ace_input_files'));
            //console.log($(this).data('ace_input_method'));
            has_error = false;
        }).on('file.error.ace', function (e, info) {
            has_error = true;
            if (info.invalid_count) {
                var error_msg = "";
                if (info.error_list.hasOwnProperty("ext")) {
                    for (var i = 0; i < info.error_list.ext.length; i++) {
                        error_msg += "File '" + info.error_list.ext[i] + "' is invalid extension (allow: " + allow_ext + ")<br/>";
                    }
                }
                if (info.error_list.hasOwnProperty("mime")) {
                    for (var i = 0; i < info.error_list.mime.length; i++) {
                        error_msg += "File '" + info.error_list.mime[i] + "' is invalid mimetype<br/>";
                    }
                }
                if (info.error_list.hasOwnProperty("size")) {
                    for (var i = 0; i < info.error_list.size.length; i++) {
                        error_msg += "File '" + info.error_list.size[i] + "' is too large(max size: " + max_size / 1024 + "KB) <br/>";
                    }
                }
                var parent = self.closest(".form-group");
                var error = parent.find("label.help-block");
                if (!error.length) {
                    parent.append("<label class='text-error help-block col-sm-8 col-xs-12 col-sm-offset-3'></label>").show();
                }
                parent.find("label.help-block").html(error_msg);
                error.show();
            } else {
                self.closest(".form-group").find("label.help-block").hide();
            }
        });
    });
}

function build_editor() {
    $(".ckeditor").each(function () {
        var name = $(this).attr("name");
        var finder = $(this).attr("data-ckfinder");
        window[name] = CKEDITOR.replace($(this).get(0),
            {
//                    toolbar: [
//                        ['NewPage', 'DocProps', 'Preview', '-', 'Templates'],
//                        ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'],
//                        ['Find', 'Replace', '-', 'SelectAll'],
//                        ['Link', 'Unlink', 'Anchor'],
//                        ['Image', 'Table', 'HorizontalRule', 'SpecialChar', 'PageBreak'],
//                        ['Maximize', 'ShowBlocks'],
//                        ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl'],
//                        ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat'],
//                        ['Format', 'Font', 'FontSize'],
//                        ['TextColor', 'BGColor']
//                    ],
                height: '500px',
                width : '774px'
            });
        CKFinder.setupCKEditor(window[name], finder);
    });
}

function make_alias($title, $separator, $lowercase) {
    if ($separator === undefined) {
        $separator = "-";
    }
    if ($lowercase === undefined) {
        $lowercase = true;
    }
    $title = $.trim($title);
    $title = $title.replace(/\s+/gi, ' ');
    $title = $title.replace(/á|à|ạ|ả|ã|ă|ắ|ằ|ặ|ẳ|ẵ|â|ấ|ầ|ậ|ẩ|ẫ/g, "a");
    $title = $title.replace(/Á|À|Ạ|Ả|Ã|Â|Ấ|Ầ|Ậ|Ẩ|Ẫ|Ă|Ắ|Ằ|Ặ|Ẳ|Ẵ/g, "A");
    $title = $title.replace(/ó|ò|ọ|ỏ|õ|ô|ố|ồ|ộ|ổ|ỗ|ơ|ớ|ờ|ợ|ở|ỡ/g, "o");
    $title = $title.replace(/Ô|Ố|Ồ|Ộ|Ổ|Ỗ|Ó|Ò|Ọ|Ỏ|Õ|Ơ|Ớ|Ờ|Ợ|Ở|Ỡ/g, "O");
    $title = $title.replace(/é|è|ẹ|ẻ|ẽ|ê|ế|ề|ệ|ể|ễ/g, "e");
    $title = $title.replace(/Ê|Ế|Ề|Ệ|Ể|Ễ|É|È|Ẹ|Ẻ|Ẽ/g, "E");
    $title = $title.replace(/ú|ù|ụ|ủ|ũ|ư|ứ|ừ|ự|ử|ữ/g, "u");
    $title = $title.replace(/Ư|Ứ|Ừ|Ự|Ử|Ữ|Ú|Ù|Ụ|Ủ|Ũ/g, "U");
    $title = $title.replace(/í|ì|ị|ỉ|ĩ/g, "i");
    $title = $title.replace(/Í|Ì|Ị|Ỉ|Ĩ/g, "I");
    $title = $title.replace(/ý|ỳ|ỵ|ỷ|ỹ/g, "y");
    $title = $title.replace(/Ý|Ỳ|Ỵ|Ỷ|Ỹ/g, "Y");
    $title = $title.replace(/đ/g, "d");
    $title = $title.replace(/Đ/g, "D");

    $title = $title.replace(/\{|\}|\$|\||\\|`|!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_/g, $separator);
    $title = $title.replace(/\-+/g, $separator);
    $title = $title.replace(/^\-+|\-+$/g, "");
    $title = $title.replace(/[^0-9A-Za-z\-]/g, "");

    if ($lowercase) {
        $title = $title.toLowerCase();
    }
    return $title;
}

function make_random_string(length) {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for (var i = 0; i < length; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}