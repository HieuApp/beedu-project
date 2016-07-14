<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
                <span type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </span>
            <h4 class="modal-title">Thêm đơn hàng</h4>
        </div>
        <form id="form-material-detail"
              class="form-horizontal e_add_form e_ajax_submit"
              action="<?php echo $save_link; ?>"
              enctype="multipart/form-data"
              method="POST" role="form">
            <div class="warehouse-container">
                <label class=""><h4>Chọn loại đơn hàng</h4></label>
                <div class="form-group">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8">
                        <select class="sl-size" id="order-type-input" name="type">
                            <option value="-1">Xuất</option>
                            <option value="1">Nhập</option>
                        </select>
                    </div>
                    <div class="col-sm-2"></div>
                </div>
                <h5 class="export-title">Tạo đơn hàng xuất nguyên phụ liệu</h5>
                <h5 class="import-title" hidden>Tạo đơn hàng nhập nguyên phụ liệu</h5>
                <div class="order-material-info">
                    <div class="ix-material-info">
                        <div class="form-group">
                            <label class="col-sm-3" for="form-field-1">Ngày nhập</label>
                            <div class="col-sm-9">
                                <input type="date" name="date" class="sl-size form-control">
                            </div>
                        </div>
                        <div class="form-group export-lot-code">
                            <label class="col-sm-3" for="form-field-1">Đơn vị nhận</label>
                            <div class="col-sm-9">
                                <select class="sl-size receiver-unit-input">
                                    <?php
                                    if (isset($lines)) {
                                        foreach ($lines as $item) {
                                            $name = $item->name;
                                            $id = $item->id;
                                            echo '<option value="' . $id . '">' . $name . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group import-receiver-unit" hidden>
                            <label class="col-sm-3" for="form-field-1">Mã lô</label>
                            <div class="col-sm-9">
                                <input class="form-control sl-size" type="text" name="id_lot" required>
                            </div>
                        </div>
                        <div class="form-group import-receiver-unit" hidden>
                            <label class="col-sm-3">Kho hàng</label>
                            <div class="col-sm-9">
                                <select class="form-control sl-size" name="warehouse_name">
                                    <?php
                                    if (isset($warehouses)) {
                                        foreach ($warehouses as $item) {
                                            $name = $item->name;
                                            $id = $item->id;
                                            echo '<option value="' . $id . '">' . $name . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="btn btn-info" id="btn-add-detail-weight">Chi tiết khối lượng nhập</div>
                <div class="detail-weight-template" hidden>
                    <div class="detail-content">
                        <input name="weight_count" id="input_weight_count" type="hidden"
                               value="<?php echo isset($weight_details) ? count($weight_details) : 0 ?>"/>
                        <div class="detail-input-title">
                            <div class="col-sm-3">Tên nguyên phụ liệu</div>
                            <div class="col-sm-3">Số lượng</div>
                            <div class="col-sm-2">Đơn vị</div>
                            <div class="col-sm-4">Ghi chú</div>
                        </div>
                        <div class="weight-detail-template hidden">
                            <?php if (!isset($weight_details)) {
                                $weight_input_index = 1; ?>
                                <div class="weight-detail-inner">
                                    <div class="col-sm-3">
                                        <select class="form-control select_name_input"
                                                name="material_name_<?php echo $weight_input_index; ?>">
                                            <?php
                                            if (isset($materials)) {
                                                foreach ($materials as $item) {
                                                    $name = $item->material_name;
                                                    $id = $item->id;
                                                    echo '<option value="' . $id . '">' . $name . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="number" class="form-control num_quantity_input"
                                               name="quantity_$weight_input_index" min="0" max="">
                                    </div>
                                    <div class="col-sm-2">
                                        <select class="form-control" name="material_unit">
                                            <?php
                                            if (isset($materials)) {
                                                foreach ($materials as $item) {
                                                    $name = $item->material_unit;
                                                    echo '<option value="">' . $name . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control text_note_input"
                                               name="item_note_$weight_input_index">
                                    </div>
                                </div>
                                <?php $weight_input_index++;
                            } ?>
                        </div>
                        <div class="add-detail-ix-place-holder"></div>
                    </div>
                    <div class="btn btn-info btn-kc" id="add-detail-ix">Thêm</div>
                </div>
                <div class="order-material-info">
                    <div class="ix-material-info">
                        <div class="form-group">
                            <label class="col-sm-3">Note</label>
                            <div class="col-sm-9">
                          <textarea rows="4" type="text" id="form-field-1-1" placeholder="Text Field"
                                    class="form-control" name="note"/></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">
                    <i class="ace-icon fa fa-save "></i> Save
                </button>
                <input type="reset" class="btn"/>
                <button type="button" class="b_view b_add b_edit btn" data-dismiss="modal">Hủy</button>
            </div>
        </form>
    </div>
</div>