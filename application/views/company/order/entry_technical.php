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
        <li class="active">
            <a href="#">
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

        <form>
            <div class="row">
                <div class="col-sm-6">
                    <div class="widget-box">
                        <div class="widget-header">
                            <h4 class="widget-title">Gửi tập tin thông số kỹ thuật đơn hàng</h4>
                            <div class="widget-toolbar">
                                <a href="#" data-action="collapse">
                                    <i class="ace-icon fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="widget-body">
                            <div class="widget-main">
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <input multiple="" type="file" id="input-upload-file"/>

                                        <!-- /section:custom/file-input -->
                                    </div>
                                </div>

                                <!-- #section:custom/file-input.filter -->
                                <label>
                                    <input type="checkbox" name="file-format" id="id-file-format"
                                           class="ace"/>
                                    <span class="lbl"> Allow only images</span>
                                </label>

                                <!-- /section:custom/file-input.filter -->
                            </div>
                        </div>
                    </div>
                </div>
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