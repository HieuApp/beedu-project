<div class="page-content">
    <h1><?php echo $order_id == 0 ? "Tạo đơn hàng" : "Sửa đơn hàng"; ?></h1>
    <ul class="nav nav-pills page-nav-pills">
        <li>
            <a href="<?php echo site_url($this->name["class"] . "/entry/{$order_id}/general") ?>">Thông tin chung</a>
        </li>
        <li class="active">
            <a href="#">
                Chi tiết
            </a>
        </li>
        <li>
            <a href="<?php echo site_url($this->name["class"] . "/entry/{$order_id}/technical") ?>">
                Thông số kỹ thuật
            </a>
        </li>
        <li>
            <a href="<?php echo site_url($this->name["class"] . "/entry/{$order_id}/material") ?>">
                Nguyên phụ liệu
            </a>
        </li>
        <li>
            <a href="<?php echo site_url($this->name["class"] . "/entry/{$order_id}/producing_steps") ?>">
                Quy trình sản xuất
            </a>
        </li>
    </ul>

    <?php if ($order_id == 0) { ?>

        <div class="alert alert-warning">
            <button type="button" class="close" data-dismiss="alert">
                <i class="ace-icon fa fa-times"></i>
            </button>
            <strong>Warning!</strong>
            Bạn phải gửi "Thông tin chung" trước khi điền những tab khác.
            <br/>
        </div>

    <?php } else { ?>

        <div class="old-version hidden">
            <?php if ($prepacks) { ?>
                <span id="count_mce"><?php echo count($prepacks); ?></span>
                <?php $colors_0 = $prepacks[0]['colors'];
                foreach ($colors_0 as $color_index => $color) { ?>
                    <span id="color_name_<?php echo $color_index ?>"><?php echo $color->color_name; ?></span>
                <?php } ?>
                <span id="count_color"><?php echo count($colors_0); ?></span>

                <?php foreach ($prepacks as $prepack_index => $prepack) {
                    $sizes = $prepack['sizes'];
                    $colors = $prepack['colors']; ?>
                    <span id="mce_name_<?php echo $prepack_index; ?>"><?php echo $prepack['detail']->name; ?></span>
                    <?php foreach ($colors as $color_index => $color) { ?>
                        <span
                            id="color_quantity_<?php echo $prepack_index; ?>_<?php echo $color_index ?>"><?php echo $color->quantity; ?></span>
                    <?php } ?>
                    <?php foreach ($sizes as $size_index => $size) { ?>
                        <span
                            id="size_rate_<?php echo $prepack_index; ?>_<?php echo $size->size_name; ?>"><?php echo $size->rate; ?></span>
                    <?php }
                }
            } ?>
        </div>

        <form class="form-horizontal e_add_form e_ajax_submit" role="form" method="POST"
              action="<?php echo site_url($this->name["class"] . "/save_detail") ?>">
            <input name="order_id" type="hidden" value="<?php echo $order_id ?>">
            <div class="mns-component order-detail">
                <h4>Các màu sắc và MCE trong đơn hàng</h4>
                <div class="row order-detail-top">
                    <div class="col-sm-6 order-detail-top-side">
                        <div class="order-detail-top-side-inner box-center row">
                            <label for="order-detail-color-input" class="col-sm-12">Màu sắc</label>
                            <div class="col-sm-12">
                                <input type="text" id="order-detail-color-input" class="form-control"
                                       placeholder="Thêm màu ..."/>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 order-detail-top-side">
                        <div class="order-detail-top-side-inner box-center row">
                            <label for="order-detail-mce-input" class="col-sm-12">MCE</label>
                            <div class="col-sm-12">
                                <input type="text" id="order-detail-mce-input" class="form-control"
                                       placeholder="Thêm MCE ..."/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row padding-18">
                    <div class="col-sm-12">
                        <button type="button" class="pull-right btn btn-primary" id="btn-update-color-mce">
                            <i class="ace-icon fa fa-check"></i>
                            Cập nhật màu sắc và MCE
                        </button>
                    </div>
                </div>
            </div>
            <hr>

            <div class="mns-component">
                <h4>Chi tiết về kích cỡ</h4>
                <div class="mns-component-body">
                    <div class="mns-table-head">
                        <div class="row mns-table-row mns-table-row-head text-center">
                            <div class="col-sm-2">
                                <label>MCE</label>
                            </div>
                            <div class="col-sm-1">
                                <label>XS</label>
                            </div>
                            <div class="col-sm-1">
                                <label>S</label>
                            </div>
                            <div class="col-sm-1">
                                <label>M</label>
                            </div>
                            <div class="col-sm-1">
                                <label>L</label>
                            </div>
                            <div class="col-sm-1">
                                <label>XL</label>
                            </div>
                            <div class="col-sm-1">
                                <label>XXL</label>
                            </div>
                            <div class="col-sm-2">
                                <label>Tổng</label>
                            </div>
                            <div class="col-sm-2">
                                <label>Màu sắc</label>
                            </div>
                        </div>
                    </div>

                    <input name="mce_count" type="hidden" id="mce_count"
                           value="<?php echo isset($mce_list) ? count($mce_list) : 0 ?>"/>
                    <input name="color_count" type="hidden" id="color_count"
                           value="<?php echo isset($color_list) ? count($color_list) : 0 ?>"/>

                    <div class="mce-quantity-template hidden">
                        <div class="mns-table mce_container">
                            <div class="row mns-table-row mce_input">
                                <div class="col-sm-2 text-center text-uppercase">
                                    <input type="text" class="mce_name form-control input-as-label" readonly>
                                </div>
                                <div class="col-sm-1">
                                    <input type="number" min="0" max="100" class="form-control form-mce-rate"
                                           data-size="xs"/>
                                </div>
                                <div class="col-sm-1">
                                    <input type="number" min="0" max="100" class="form-control form-mce-rate"
                                           data-size="s"/>
                                </div>
                                <div class="col-sm-1">
                                    <input type="number" min="0" max="100" class="form-control form-mce-rate"
                                           data-size="m"/>
                                </div>
                                <div class="col-sm-1">
                                    <input type="number" min="0" max="100" class="form-control form-mce-rate"
                                           data-size="l"/>
                                </div>
                                <div class="col-sm-1">
                                    <input type="number" min="0" max="100" class="form-control form-mce-rate"
                                           data-size="xl"/>
                                </div>
                                <div class="col-sm-1">
                                    <input type="number" min="0" max="100" class="form-control form-mce-rate"
                                           data-size="xxl"/>
                                </div>
                                <div class="col-sm-2">
                                    <span class="mce_rate_total"></span>/<span class="color_total"></span>
                                </div>
                            </div>
                            <div class="row mns-table-row color_mce_input">
                                <div class="col-sm-1 col-sm-offset-2">
                                    <label class="color-mce-count" data-size="xs">0</label>
                                </div>
                                <div class="col-sm-1">
                                    <label class="color-mce-count" data-size="s">0</label>
                                </div>
                                <div class="col-sm-1">
                                    <label class="color-mce-count" data-size="m">0</label>
                                </div>
                                <div class="col-sm-1">
                                    <label class="color-mce-count" data-size="l">0</label>
                                </div>
                                <div class="col-sm-1">
                                    <label class="color-mce-count" data-size="xl">0</label>
                                </div>
                                <div class="col-sm-1">
                                    <label class="color-mce-count" data-size="xxl">0</label>
                                </div>
                                <div class="col-sm-2">
                                    <input type="number" min="0" step="100" class="form-control color_quantity"/>
                                </div>
                                <div class="col-sm-2 text-center">
                                    <input type="text" class="color_name form-control input-as-label" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mce-quantity-real"></div>
                </div>
            </div>
            <hr>

            <div class="mns-component">
                <h4>Tổng số lượng từng màu sắc</h4>
                <table
                    class="color-total-quantity-table-template table table-striped table-bordered table-hover hidden">
                    <thead class="color-total-quantity-thead">
                    <tr>
                        <th>Tên màu</th>
                        <th>XS</th>
                        <th>S</th>
                        <th>M</th>
                        <th>L</th>
                        <th>XL</th>
                        <th>XXL</th>
                        <th>Tổng</th>
                    </tr>
                    </thead>

                    <tbody class="color-total-quantity-tbody">
                    <tr class="color-total-quantity-tr">
                        <td class="color-total-name">
                            Deep black
                        </td>
                        <td class="color-total-count" data-size="xs">0</td>
                        <td class="color-total-count" data-size="s">0</td>
                        <td class="color-total-count" data-size="m">0</td>
                        <td class="color-total-count" data-size="l">0</td>
                        <td class="color-total-count" data-size="xl">0</td>
                        <td class="color-total-count" data-size="xxl">0</td>
                        <td class="color-total-quantity">0</td>
                    </tr>
                    </tbody>

                    <tbody class="color-total-quantity-tbody-real"></tbody>
                </table>

                <div class="color-total-quantity-table-placeholder"></div>
            </div>

            <div class="clearfix form-actions">
                <div class="col-sm-offset-5 col-sm-1">
                    <input type="submit" class="btn btn-primary"/>
                </div>
                <div class="col-sm-1">
                    <input type="reset" class="btn"/>
                </div>
            </div>
        </form>

    <?php } ?>
</div>