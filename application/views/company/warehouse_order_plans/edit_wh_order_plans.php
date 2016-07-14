<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
                <span type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </span>
            <h4 class="modal-title">Sửa lịch trình đơn hàng về kho</h4>
        </div>
        <form id="form-material-detail"
              class="form-horizontal e_add_form e_ajax_submit"
              action="<?php echo $save_link; ?>"
              enctype="multipart/form-data"
              method="POST" role="form">
            <div class="warehouse-container">
                <div class="order-material-info">
                    <div class="ix-material-info">
                        <?php
                        foreach ($wh_activities as $item) { ?>
                            <div class="form-group">
                                <label class="col-sm-3">Người tạo đơn hàng </label>
                                <div class="col-sm-9">
                                    <select class="form-control sl-size" name="user_create_order">
                                        <?php foreach ($users as $user) {
                                            $username = $user->name;
                                            $id = $user->id;
                                            $selected = ($username === "$item->user_name") ? "selected" : "";
                                            echo "<option value='{$id}' {$selected}>{$username}</option>";
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3">Mã lô </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="id_lot"
                                           value="<?php echo $item->material_pack; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3">Kho hàng</label>
                                <div class="col-sm-9">
                                    <select class="form-control sl-size" name="warehouse_name">
                                        <?php foreach ($warehouses as $warehouse) {
                                            $wh = $warehouse->name;
                                            $id = $warehouse->id;
                                            $selected = ($wh === "$item->warehouse_name") ? "selected" : "";
                                            echo "<option value='{$id}' {$selected}>{$wh}</option>";
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3" for="form-field-1">Ngày về dự kiến</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="time-receive"
                                           value="<?php echo $item->date; ?>">
                                </div>
                            </div>
                        <?php }
                        ?>
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
                            <?php
                            foreach ($activity_items as $item) {
                                ?>
                                <div class="weight-detail-inner">
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control"
                                               value="<?php echo $item->order_name ?> - <?php echo $item->material_name; ?>">
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control"
                                               value="<?php echo $item->quantity; ?>">
                                    </div>
                                    <div class="col-sm-2">
                                        <select class="form-control sl-size" name="warehouse_name">
                                            <?php foreach ($materials as $material) {
                                                $wh = $material->material_unit;
                                                $selected = ($wh === " $item->material_unit") ? "selected" : "";
                                                echo "<option value='' {$selected}>{$wh}</option>";
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control"
                                               value="<?php echo $item->note; ?>">
                                    </div>
                                    <div class="col-sm-1">
                                        <i title="Cancel this rating!"
                                           class="remCF raty-cancel cancel-off-png"
                                           data-alt="x">
                                        </i>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
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
                                <?php
                                foreach ($wh_activities as $item) {
                                    $name = $item->note;
                                    echo '<input type="text" name="note" class="form-control" value="' . $name . '">';
                                }
                                ?>
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