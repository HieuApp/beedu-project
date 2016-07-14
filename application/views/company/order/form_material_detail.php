<div class="edit-order-container">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form-material-detail"
                  class="form-horizontal e_add_form e_ajax_submit"
                  action="<?php echo $save_link; ?>"
                  enctype="multipart/form-data"
                  method="POST" role="form">
                <div class="modal-header">
                    <span type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </span>
                    <h4 class="modal-title"><?php echo isset($material_detail_list) ? "Sửa" : "Thêm" ?> nguyên phụ
                        liệu</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="<?php echo $order_id; ?>" name="order_id"/>
                    <div>
                        <?php $selected_unit = "ybs";
                        $selected_color_id = 1;
                        if (isset($material_detail_list)) {
                            $material_detail = array_values($material_detail_list)[0];
                            $material = $material_detail["detail"];
                            $sizes = $material_detail["sizes"];
                            $selected_unit = $material->unit;
                            $selected_color_id = $material->color_id;
                        } ?>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="txt-material-name">
                                Tên nguyên liệu
                            </label>
                            <div class="col-sm-9">
                                <input type="text" id="txt-material-name" name="material_name"
                                       placeholder="Tên nguyên liệu" class="form-control" required
                                    <?php echo isset($material) ? "value='{$material->name}'" : ""; ?>
                                />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="txt-material-description">
                                Mô tả
                            </label>
                            <div class="col-sm-9">
                            <textarea rows="4" id="txt-material-description" name="material_description"
                                      placeholder="Hãy viết mô tả về nguyên liệu này..."
                                      class="form-control"><?php echo isset($material) ? $material->description : "" ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-6">
                                <label class="col-sm-6 control-label no-padding-right" for="slt-material-unit">
                                    Đơn vị
                                </label>
                                <div class="col-sm-6">
                                    <select class="form-control" id="slt-material-unit" name="material_unit">
                                        <?php foreach ($units as $unit => $unit_display_text) { ?>
                                            <option value="<?php echo $unit ?>"
                                                <?php echo $unit == $selected_unit ? "selected" : "" ?>>
                                                <?php echo $unit_display_text ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="col-sm-3 control-label no-padding-right"
                                       for="slt-material-color">Màu</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="slt-material-color" name="material_color">
                                        <?php foreach ($colors as $color_id => $color_name) { ?>
                                            <option value="<?php echo $color_id ?>"
                                                <?php echo $color_id == $selected_color_id ? "selected" : "" ?>>
                                                <?php echo $color_name ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div>
                        <h4 class="title-name">Chi tiết từng kích cỡ</h4>
                        <input name="size_count" id="input_size_count" type="hidden"
                               value="<?php echo isset($sizes) ? count($sizes) : 0 ?>"/>
                        <div class="title-size">
                            <div class="col-sm-1">
                                Cỡ
                            </div>
                            <div class="col-sm-2">
                                Định mức
                            </div>
                            <div class="col-sm-2">
                                SL áo
                            </div>
                            <div class="col-sm-2">
                                SL phụ kiện cần
                            </div>
                            <div class="col-sm-2">
                                SL phụ kiện cấp
                            </div>
                            <div class="col-sm-3">
                                Ngày về dự kiến
                            </div>
                        </div>

                        <?php if (isset($sizes)) {
                            $size_input_index = 1;
                            foreach ($sizes as $size) { ?>

                                <div class="content-input add-size-content-inner">
                                    <div class="col-sm-1 margin-top-12 wrap-material-size-name">
                                        <input type="text" class="form-control txt-material-size-name"
                                               name="size_name_<?php echo $size_input_index; ?>"
                                               value="<?php echo $size->size_name ?>">
                                    </div>
                                    <div class="col-sm-2 margin-top-12 wrap-material-size-limit">
                                        <input type="number"
                                               class="form-control num-material-size-limit num-material-size-cons"
                                               name="size_cons_<?php echo $size_input_index; ?>"
                                               value="<?php echo $size->cons; ?>"
                                        />
                                    </div>
                                    <div class="col-sm-2 margin-top-12 wrap-material-size-quantity">
                                        <input type="number" class="form-control num-material-size-quantity"
                                               name="size_quantity"
                                               value="<?php echo $size->quantity; ?>"
                                        />
                                    </div>
                                    <div class="col-sm-2 margin-top-12 wrap-material-size-quantity-needed">
                                        <input type="number"
                                               class="form-control num-material-size-quantity-needed num-material-size-quantity-issued"
                                               name="size_quantity_issued_<?php echo $size_input_index; ?>"
                                               value="<?php echo $size->quantity_issued; ?>"
                                        />
                                    </div>
                                    <div class="col-sm-2 margin-top-12 wrap-material-size-quantity-provided">
                                        <input type="number"
                                               class="form-control num-material-size-quantity-provided num-material-size-quantity-factual"
                                               name="size_quantity_factual_<?php echo $size_input_index; ?>"
                                               value="<?php echo $size->quantity_factual; ?>"
                                        />
                                    </div>
                                    <div class="col-sm-3 margin-top-12 wrap-material-size-date">
                                        <input type="date" class="form-control"
                                               name="size_date_<?php echo $size_input_index; ?>">
                                        <!--TODO Load this-->
                                    </div>
                                </div>

                                <?php $size_input_index++;
                            }
                        } ?>

                        <div class="add-size-content-template hidden">
                            <div class="content-input kc add-size-content-inner">
                                <div class="col-sm-1 margin-top-12 wrap-material-size-name">
                                    <input type="text" class="form-control txt-material-size-name" name="size_name">
                                    <!--TODO Use auto fill instead-->
                                </div>
                                <div class="col-sm-2 margin-top-12 wrap-material-size-limit">
                                    <input type="number"
                                           class="form-control num-material-size-limit num-material-size-cons"
                                           name="size_cons">
                                </div>
                                <div class="col-sm-2 margin-top-12 wrap-material-size-quantity">
                                    <input type="number" class="form-control num-material-size-quantity"
                                           name="size_quantity"
                                           value="150">
                                </div>
                                <div class="col-sm-2 margin-top-12 wrap-material-size-quantity-needed">
                                    <input type="number"
                                           class="form-control num-material-size-quantity-needed num-material-size-quantity-issued"
                                           name="size_quantity_issued">
                                </div>
                                <div class="col-sm-2 margin-top-12 wrap-material-size-quantity-provided">
                                    <input type="number"
                                           class="form-control num-material-size-quantity-provided num-material-size-quantity-factual"
                                           name="size_quantity_factual">
                                </div>
                                <div class="col-sm-3 margin-top-12 wrap-material-size-date">
                                    <input type="date" class="form-control" name="size_date">
                                </div>
                            </div>
                        </div>

                        <div class="add-size-content-placeholder"></div>

                        <div class="clearfix">
                            <button type="button" class="btn btn-info pull-right margin-top-12" id="add-size-material">
                                Thêm kích cỡ
                            </button>
                        </div>
                    </div>
                    <hr>

                    <div>
                        <div class="form-group row">
                            <label class="col-sm-3 control-label no-padding-right" for="txt-material-note">
                                Ghi chú
                            </label>
                            <div class="col-sm-9">
                                <textarea rows="4" type="text" id="txt-material-note" placeholder="Thêm ghi chú..."
                                          class="form-control" name="material_note"/></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="submit" class="btn btn-success"/>
                    <input type="reset" class="btn"/>
                    <button type="button" class="b_view b_add b_edit btn" data-dismiss="modal">Hủy</button>
                </div>
            </form>
        </div>
    </div>
</div>