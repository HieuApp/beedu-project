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
        <li class="active">
            <a href="#">
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

        <div class="clearfix">
            <a href="<?php echo site_url("company/order/form_order_material/{$order_id}"); ?>"
               class="btn btn-primary pull-right margin-bottom-12 e_ajax_link">
                Thêm nguyên liệu
            </a>
        </div>

        <table class="table table-group-by table-bordered table-hover">
            <thead>
            <tr>
                <th>Tên nguyên liệu</th>
                <th>Đơn vị</th>
                <th>Màu</th>
                <th>Cỡ</th>
                <th>Định mức</th>
                <th>SL phụ liệu cần cho MO</th>
                <th>Chênh lệch</th>
                <th>Ghi chú</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php if ($material_detail_list) foreach ($material_detail_list as $item) {
                $material = $item["detail"]; ?>
                <tr class="material-normal-tr">
                    <td class="td-material-name">
                        <?php echo $material->name ?>
                    </td>
                    <td class="td-material-unit">
                        <?php echo $material->unit ?>
                    </td>
                    <td class="td-material-color">
                        Color
                        <!--TODO edit Color-->
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="td-material-note">
                        <?php echo $material->note ?>
                    </td>
                    <td>
                        <div class="btn-group">
                            <button class="btn btn-xs btn-info e_ajax_link"
                                    href="<?php echo site_url("company/order/form_order_material/{$order_id}/{$material->id}"); ?>">
                                <i class="ace-icon fa fa-pencil bigger-120"></i>
                            </button>
                            <button class="btn btn-xs btn-danger e_ajax_link"
                                    href="<?php echo site_url("company/order/delete_order_material/{$order_id}/{$material->id}"); ?>">
                                <i class="ace-icon fa fa-trash-o bigger-120"></i>
                            </button>
                        </div>
                    </td>
                </tr>

                <?php $sizes = $item["sizes"];
                foreach ($sizes as $size) { ?>
                    <tr class="material-sub-tr">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="td-material-size text-uppercase"><?php echo $size->size_name ?></td>
                        <td class="td-material-size-cons"><?php echo $size->cons ?></td>
                        <td class="td-material-accessories-quantity"><?php echo $size->quantity ?></td>
                        <td class="td-material-accessories-balance"><?php echo $size->balance ?></td>
                        <td></td>
                        <td></td>
                    </tr>
                <?php } ?>
            <?php } ?>

            <tr class="material-command-tr">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <div class="btn-group">
                        <button href="<?php echo site_url("company/order/form_order_material/{$order_id}"); ?>"
                                class="btn btn-xs e_ajax_link">
                            <i class="glyphicon glyphicon-plus-sign"></i>
                        </button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>

    <?php } ?>
</div>