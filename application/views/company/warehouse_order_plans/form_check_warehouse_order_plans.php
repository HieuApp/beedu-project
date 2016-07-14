<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
                <span type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </span>
            <h4 class="modal-title">Xác nhận thông tin hàng về kho</h4>
        </div>
        <form id="form-check-warehouse-order-plan"
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
                                    <input class="form-control sl-size" name="user_create_order"
                                           value="<?php echo $item->user_name; ?>" readonly>
                                    </input>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3">Người cập nhật</label>
                                <div class="col-sm-9">
                                    <input class="form-control sl-size" name="user_check_order_plan"
                                           value="<?php echo $current_user->user_name; ?>" readonly>
                                    </input>
                                    <input class="form-control sl-size hidden" name="user_id_create_wh_activity"
                                           value="<?php echo $current_user->user_id; ?>" readonly>
                                    </input>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3">Mã lô </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="material_pack"
                                           value="<?php echo $item->material_pack; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3">Kho hàng</label>
                                <div class="col-sm-9">
                                    <input class="form-control sl-size" name="warehouse_name"
                                           value="<?php echo $item->warehouse_name; ?>" readonly>
                                    </input>
                                    <input class="form-control sl-size" name="warehouse_id"
                                           value="<?php echo $item->warehouse_id; ?>" readonly>
                                    </input>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3" for="form-field-1">Ngày về dự kiến</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="time-receive"
                                           value="<?php echo $item->time_receive; ?>" readonly>
                                </div>
                            </div>
                        <?php }
                        ?>
                    </div>
                    <hr>
                    <h4>Chi tiết khối lượng nhập</h4>
                    <div class="detail-weight-template">
                        <div class="detail-content">
                            <input name="weight_count" id="input_weight_count" type="hidden"
                                   value="<?php echo isset($weight_details) ? count($weight_details) : 0 ?>"/>
                            <div class="detail-input-title">
                                <div class="col-sm-3">Tên nguyên phụ liệu</div>
                                <div class="col-sm-2">Số lượng dự kiến</div>
                                <div class="col-sm-2">Thực nhập</div>
                                <div class="col-sm-4">Ghi chú</div>
                            </div>
                            <div class="">
                                <input name="template_item_count" type="hidden"
                                       value="<?php echo count($activity_items); ?>"/>
                                <?php if (!isset($count_template)) {
                                    $count_template = 1; ?>
                                    <?php
                                    foreach ($activity_items as $item) {
                                        ?>

                                        <div class="weight-detail-inner">
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control"
                                                       value="<?php echo $item->order_name ?> - <?php echo $item->material_name; ?>"
                                                       readonly>
                                                <input type="text" class="form-control hidden"
                                                       name="material_balance_id_<?php echo $count_template; ?>"
                                                       value="<?php echo $item->material_balance_id; ?>"
                                                       readonly>
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control"
                                                       value="<?php echo $item->quantity; ?>" readonly>
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control"
                                                       value=""
                                                       name="quantity_factual_<?php echo $count_template; ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control"
                                                       name="note_<?php echo $count_template; ?>"
                                                       value="<?php echo $item->note; ?>">
                                            </div>
                                            <div class="col-sm-1">
                                                <i title="Cancel this rating!"
                                                   class="remCF raty-cancel cancel-off-png"
                                                   data-alt="x">
                                                </i>
                                            </div>
                                        </div>
                                        <?php $count_template++;
                                    } ?>
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
                                                       min="0" value="0"
                                                       readonly>
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="number" class="form-control num_quantity_input"
                                                       placeholder="Số lượng thực nhập"
                                                       name="quantity_$weight_input_index" min="0">
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