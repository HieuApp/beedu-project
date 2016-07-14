<div class="page-content">
    <h1><?php $_have_order_id = $order_id != 0;
        echo $_have_order_id ? "Tạo đơn hàng" : "Sửa đơn hàng"; ?></h1>
    <ul class="nav nav-pills page-nav-pills">
        <li class="active">
            <a href="#">Thông tin chung</a>
        </li>
        <li>
            <a href="<?php echo site_url($this->name["class"] . "/entry/{$order_id}/detail") ?>">
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

    <div class="row">
        <form class="form-horizontal e_add_form e_ajax_submit" role="form" method="POST"
              action="<?php echo site_url($this->name["class"] . "/save_entry_general") ?>">
            <input name="id" type="hidden" value="<?php echo $_have_order_id ? $order_id : NULL; ?>">
            <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6">
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="txt-customer">
                        Khách hàng
                    </label>
                    <div class="col-sm-9">
                        <input type="text" id="txt-customer" placeholder="Nhập tên khách hàng" name="customer"
                            <?php echo $_have_order_id ? "value=\"{$order->customer}\"" : NULL; ?>
                               class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="txt-brand-name">
                        Brand Name
                    </label>
                    <div class="col-sm-9">
                        <input type="text" id="txt-brand-name" placeholder="Nhập tên thương hiệu" name="brand_name"
                            <?php echo $_have_order_id ? "value=\"{$order->brand_name}\"" : NULL; ?>
                               class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="txt-name">
                        Mã hàng
                    </label>
                    <div class="col-sm-9">
                        <input type="text" id="txt-name" placeholder="Mã hàng" name="name" class="form-control"
                            <?php echo $_have_order_id ? "value=\"{$order->name}\"" : NULL; ?>/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="date-order" class="col-sm-3 control-label no-padding-right">
                        Ngày tạo đơn hàng
                    </label>
                    <div class="col-xs-4 col-sm-3">
                        <div class="input-group col-sm-9">
                            <input type="date" class="form-control" name="date_order"
                                <?php echo $_have_order_id ? "value=\"" . substr($order->date_order, 0, 10) . "\"" : NULL; ?>/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="date-begin" class="col-sm-3 control-label no-padding-right">
                        Ngày bắt đầu
                    </label>
                    <div class="col-xs-4 col-sm-3">
                        <div class="input-group col-sm-9">
                            <input type="date" class="form-control" name="date_begin"
                                <?php echo $_have_order_id ? "value=\"" . substr($order->date_begin, 0, 10) . "\"" : NULL; ?>/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="date-expired" class="col-sm-3 control-label no-padding-right">
                        Ngày kết thúc
                    </label>
                    <div class="col-xs-4 col-sm-3">
                        <div class="input-group col-sm-9">
                            <input type="date" class="form-control" name="date_expired"
                                <?php echo $_have_order_id ? "value=\"" . substr($order->date_expired, 0, 10) . "\"" : NULL; ?>/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="date-timepicker1" class="col-sm-3 control-label no-padding-right">
                        Ngày xuất
                    </label>
                    <div class="col-xs-4 col-sm-3">
                        <div class="input-group col-sm-9">
                            <input type="date" class="form-control" name="date_export"
                                <?php echo $_have_order_id ? "value=\"" . substr($order->date_export, 0, 10) . "\"" : NULL; ?>/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="txt-note">
                        Ghi chú
                    </label>
                    <div class="col-sm-9">
                        <textarea rows="4" cols="450" class="autosize-transition form-control" id="txt-note"
                                  name="note"><?php echo $_have_order_id ? $order->note : NULL; ?></textarea>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 form-actions">
                <div class="col-sm-offset-5 col-sm-1">
                    <input type="submit" class="btn btn-primary"/>
                </div>
                <div class="col-sm-1">
                    <input type="reset" class="btn"/>
                </div>
            </div>
        </form>
    </div>
</div>