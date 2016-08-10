<?php foreach ($document_by_category as $document_category_item) {
    ?>
    <div class="container">
        <div class="row column text-center">
            <a class="group-title left"
               href="<?php echo base_url("document/view_category") . "/" . $document_category_item['category']->id; ?>">
                <i class="material-icons vertical-sub">storage</i><?php echo $document_category_item['category']->name; ?>
            </a>
        </div>
        <hr>
        <div class="row">
            <?php
            if (count($document_category_item['list_document_in_category'])) {
                foreach ($document_category_item['list_document_in_category'] as $document) {
                    ?>
                    <div class="col s6 m6 l2">
                        <a href="<?php echo base_url("document_preview/view_detail" . "/" . $document->id); ?>">
                            <img class="thumbnail" src="<?php echo base_url($document->avatar); ?>">
                        </a>
                        <a href="<?php echo base_url("document_preview/view_detail" . "/" . $document->id); ?>">
                            <?php echo $document->name; ?></a></h5>
                        <br><span><?php echo $document->count_downloaded; ?> downloads</span>
                        <a href="<?php echo base_url("document/download" . "/" . $document->id); ?>"
                                class="waves-effect waves-light btn btn-download">Download
                        </a>
                    </div>

                    <?php
                }
            } else { ?>
                Chưa có tài liệu nào trong chuyên mục này!!!
            <?php } ?>
        </div>
    </div>
    <?php
} ?>