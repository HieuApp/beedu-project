<div class="pull-left padding-10 no-padding-top no-padding-bottom">
    <div id="dataTable_length" class="dataTables_length">
        <button href="<?php echo $delete_list_link; ?>"
                class="btn btn-danger btn-sm  e_ajax_link e_ajax_confirm delete_list_button for_select"
                style="display: none;"><i class="ace-icon fa fa-trash"></i>
            Xóa
        </button>
        <button href="# " class="btn btn-sm e_reverse_button for_select "
                style="display: none;"><i class="ace-icon fa fa-refresh"></i>
            Đảo ngược
        </button>
        <label>
            <span>
            Hiển thị
                <input name="post" type="text"
                       class="input-sm changer_number_record e_changer_number_record"
                       value="20"> bản ghi trên 1 trang
            </span>
        </label>
    </div>
</div>