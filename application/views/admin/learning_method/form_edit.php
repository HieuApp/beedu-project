<form class="form-horizontal e_add_form e_ajax_submit"
      action="<?php echo $save_link; ?>"
      enctype="multipart/form-data"
      method="POST" role="form">
    <div class="modal-header">
                <span type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </span>
        <h4 class="modal-title"><?php echo $form_title; ?></h4>
    </div>
    <div class="modal-body bgwhite">
        <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label  no-padding-right">
                Avatar cũ
            </label>
            <div class="col-sm-8 col-xs-12">
                <div class="e_file_preview_container">
                    <img src="<?php echo base_url($record_data->avatar); ?>" name="avatar"
                         class="file_preview ace_file_input">
                    <input class="hidden" value="<?php echo $record_data->avatar; ?>" name="avatar">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label  no-padding-right">
                Avatar mới
            </label>
            <div class="col-sm-8 col-xs-12">
                <div class="e_file_preview_container">
                    <input name="new_avatar" type="file" id="input-upload-img"/>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label  no-padding-right">
                Tên phương pháp học
            </label>
            <div class="col-sm-8 col-xs-12">
                <input value="<?php echo $record_data->title; ?>" name="title" type="text"
                       class="col-xs-12">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label  no-padding-right">
                Mô tả ngắn
            </label>
            <div class="col-sm-8 col-xs-12">
                <input value="<?php echo $record_data->description; ?>" name="description" type="text"
                       class="col-xs-12">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label  no-padding-right">
                Note
            </label>
            <div class="col-sm-8 col-xs-12">
                <input value="<?php echo $record_data->note; ?>" name="note" type="text" class="col-xs-12">
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="submit" class="b_add b_edit btn btn-success">
            <i class="ace-icon fa fa-save "></i> Lưu
        </button>
        <button type="reset" class="b_add btn">Nhập lại</button>
        <button type="button" class="b_view b_add b_edit btn" data-dismiss="modal">Hủy</button>
    </div>
</form>
