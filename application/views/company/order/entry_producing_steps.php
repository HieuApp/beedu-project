<div class="page-content">
    <h1><?php echo $order_id == 0 ? "Tạo đơn hàng" : "Sửa đơn hàng"; ?></h1>
    <ul class="nav nav-pills page-nav-pills">
        <li>
            <a href="<?php echo site_url($this->name["class"] . "/entry/{$order_id}/general") ?>">Thông tin chung</a>
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
        <li class="active">
            <a href="#">
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

        <h4>Các công đoạn</h4>
        <div class="row stages">
            <div class="col-xs-6">
                <table id="simple-table" class="table table-striped table-bordered table-hover processing-stages">
                    <thead>
                    <tr>
                        <th>Cắt</th>
                        <th>May</th>
                        <th>Là</th>
                        <th>Đóng thùng</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <div class="col-xs-6">
                <a onclick="alertFunction()" href="#" class="btn btn-success">
                    <span class="glyphicon glyphicon-plus"></span>
                </a>
            </div>
        </div> <!--end stages-->
        <div class="row">
            <div class="col-sm-7">
                <div class="widget-box">
                    <div class="widget-header">
                        <h4 class="widget-title">Chi tiết</h4>
                        <div class="widget-toolbar">
                            <a href="#" data-action="collapse">
                                <i class="ace-icon fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="widget-body">
                        <div class="widget-main">
                            <div id="chart_div"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-5">
                <div class="widget-box">
                    <div class="widget-header">
                        <h4 class="widget-title">Chi tiết công đoạn</h4>
                        <div class="widget-toolbar">
                            <a href="#" data-action="collapse">
                                <i class="ace-icon fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="widget-body">
                        <div class="widget-main">
                            <div class="form-group row">
                                <label class="col-xs-4" for="form-field-select-1">Công đoạn</label>
                                <div class="col-xs-5">
                                    <select class="form-control" id="form-field-select-1">
                                        <option>Cắt</option>
                                        <option>May</option>
                                        <option>Là</option>
                                        <option>Đóng thùng</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-xs-4" for="id-date-picker-1">Ngày bắt đầu</label>
                                <div class="col-xs-5">
                                    <div class="input-group">
                                        <input class="form-control date-picker"
                                               id="id-date-picker-1"
                                               type="text"
                                               data-date-format="dd-mm-yyyy"/>
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar bigger-110"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-xs-4 control-label no-padding-right"
                                       for="form-field-1">Năng
                                    xuất/ngày</label>
                                <div class="col-xs-5">
                                    <input type="number" step="100" id="form-field-1"
                                           class="col-xs-12 form-control"/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-xs-4" for="id-date-picker-1">Ngày kết thúc</label>

                                <div class="col-xs-5">
                                    <div class="input-group">
                                        <input class="form-control date-picker"
                                               id="id-date-picker-1"
                                               type="text"
                                               data-date-format="dd-mm-yyyy"/>
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar bigger-110"></i>
                                            </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-xs-4" for="form-field-select-1">Tổ thực
                                    hiện</label>
                                <div
                                    class="col-xs-8 layout-row align-space-between-start order-detail-top-side-block">
                                    <select class="form-control-details-stages form-control"
                                            id="form-field-select-1">
                                        <?php foreach ($lines as $item) { ?>
                                            <option value="<?php echo $item->id ?>">
                                                <?php echo $item->name ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <a href="#" class="btn btn-success btn-after-form-control">
                                        <span class="glyphicon glyphicon-ok"></span>
                                    </a>
                                    <a href="#" class="btn btn-warning btn-after-form-control">
                                        <span class="glyphicon glyphicon-warning-sign"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix form-actions">
            <div class="col-md-offset-3 col-md-9">
                <button class="btn btn-info" type="button">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    Add
                </button>

                <button class="btn" type="reset">
                    <i class="ace-icon fa fa-undo bigger-110"></i>
                    Reset
                </button>
            </div>
        </div>

    <?php } ?>

</div>