<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
                <span type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </span>
            <h4 class="modal-title">Thêm lịch trình đơn hàng về kho</h4>
        </div>
        <form id="form-material-detail"
              class="form-horizontal e_add_form e_ajax_submit"
              action="<?php echo $save_link; ?>"
              enctype="multipart/form-data"
              method="POST" role="form">
            <div class="warehouse-container">
                <div class="order-material-info">
                    <div class="ix-material-info">
                        <div class="form-group">
                            <label class="col-sm-3">Người tạo đơn hàng </label>
                            <div class="col-sm-9">
                                <select class="form-control sl-size" name="user_create_order">
                                    <?php
                                    if (isset($users)) {
                                        foreach ($users as $item) {
                                            $name = $item->name;
                                            $id = $item->id;
                                            echo '<option value="' . $id . '">' . $name . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3">Mã lô </label>
                            <div class="col-sm-9">
                                <input class="form-control sl-size" type="text" name="id_lot" placeholder="Mã lô hàng"
                                       required>
                            </div>
                        </div>
                        <div class="form-group">
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
                        <div class="form-group">
                            <label class="col-sm-3" for="form-field-1">Ngày về dự kiến</label>
                            <div class="col-sm-9">
                                <input class="form-control sl-size" type="date" name="time-receive">
                            </div>
                        </div>
                    </div>
                </div>
                <h3>Chi tiết khối lượng nhập</h3>
                <div class="detail-weight-template">
                    <div class="detail-content">
                        <input name="weight_count" id="input_weight_count" type="hidden"
                               value="<?php echo isset($weight_details) ? count($weight_details) : 0 ?>"/>
                        <div class="detail-input-title">
                            <div class="col-sm-3">Tên nguyên phụ liệu</div>
                            <div class="col-sm-2">Số lượng</div>
                            <div class="col-sm-2">Đơn vị</div>
                            <div class="col-sm-4">Ghi chú</div>
                        </div>
                        <div class="">
                            <div class="weight-detail-inner">
                                <div class="col-sm-3">
                                    <select class="form-control select_name_input"
                                            name="material_name">
                                        <?php
                                        if (isset($materials)) {
                                            foreach ($materials as $item) {
                                                $name = $item->material_name;
                                                $name_order = $item->order_name;
                                                $id = $item->id;
                                                echo '<option value="' . $id . '">'
                                                    . $name_order . '-' . $name . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <input type="number" class="form-control num_quantity_input"
                                           placeholder="Số lượng"
                                           name="quantity" min="0">
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
                                            <textarea rows="1" type="text" placeholder="ghi chú"
                                                      class="form-control text_note_input"
                                                      name="item_note"/>
                                    </textarea>
                                </div>
                                <div class="col-sm-1">
                                    <i title="Cancel this rating!"
                                       class="remCF raty-cancel cancel-off-png"
                                       data-alt="x">
                                    </i>
                                </div>
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
                                                        $name_order = $item->order_name;
                                                        $id = $item->id;
                                                        echo '<option value="' . $id . '">'
                                                            . $name_order . '-' . $name . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="number" class="form-control num_quantity_input"
                                                   placeholder="Số lượng"
                                                   name="quantity_$weight_input_index" min="0">
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
                                            <textarea rows="1" type="text" placeholder="ghi chú"
                                                      class="form-control text_note_input"
                                                      name="item_note_$weight_input_index"/>
                                            </textarea>
                                        </div>
                                        <div class="col-sm-1">
                                            <i title="Cancel this rating!"
                                               class="remCF raty-cancel cancel-off-png"
                                               data-alt="x">
                                            </i>
                                        </div>
                                    </div>
                                    <?php $weight_input_index++;
                                } ?>
                            </div>
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