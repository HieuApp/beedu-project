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
                Tên tài liệu
            </label>
            <div class="col-sm-8 col-xs-12">
                <input value="<?php echo $record_data->name; ?>" name="name" type="text" class="col-xs-12">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label  no-padding-right">
                Thư mục
            </label>
            <div class="col-sm-8 col-xs-12">
                <select class="form-control sl-size" name="category_id">
                    <?php foreach ($categories as $value => $value_display) {
                        $selected = ($value === "$record_data->category_id") ? "selected" : "";
                        echo "<option value='{$value}' $selected>{$value_display}</option>";
                    } ?>
                </select>
            </div>
        </div>
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
                Mô tả
            </label>
            <div class="col-sm-8 col-xs-12">
                <input value="<?php echo $record_data->description; ?>" name="description" type="text"
                       class="col-xs-12">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label  no-padding-right">
                File cũ
            </label>
            <div class="col-sm-8 col-xs-12">
                <input readonly value="<?php echo $record_data->file; ?>" name="file">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label  no-padding-right">
                File mới
            </label>
            <div class="col-sm-8 col-xs-12">
                <div class="e_file_preview_container">
                    <input name="new_file" type="file" id="input-upload-file"/>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label  no-padding-right">
                Tác giả
            </label>
            <div class="col-sm-8 col-xs-12">
                <input value="<?php echo $record_data->author; ?>" name="author" type="text" class="col-xs-12">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label  no-padding-right">
                Số lượt tải
            </label>
            <div class="col-sm-8 col-xs-12">
                <input value="<?php echo $record_data->count_downloaded; ?>" name="count_downloaded" type="text"
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
