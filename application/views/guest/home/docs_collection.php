<?php foreach ($document_by_category as $document_category_item) {
    ?>
    <div class="container">
        <div class="row column text-center">
            <a class="group-title left" href="<?php echo base_url("document"); ?>">
                <i class="material-icons vertical-sub">storage</i><?php echo $document_category_item['category_name']; ?>
            </a>
        </div>
        <hr>
        <div class="row">
            <?php
            if (count($document_category_item['list_document_in_category'])) {
                foreach ($document_category_item['list_document_in_category'] as $document) {
                    ?>
                    <div class="col s6 m6 l2">
                        <a href="<?php echo base_url("document_preview"); ?>">
                            <img class="thumbnail" src="<?php echo base_url("assets/images/300x400.png"); ?>">
                        </a>
                        <a href="<?php echo base_url("document_preview"); ?>"><?php echo $document->name; ?></a></h5>
                        <br><span>400 downloads</span>
                        <button class="waves-effect waves-light btn">Download</button>
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