<div class="container">
    <div class="row">
        <div class="col s12 m4 l8 offset-l2">

            <ul class="collection">
                <?php
                foreach ($document_by_category as $document) { ?>

                    <li class="collection-item document-item">
                        <div class="document-item">
                            <img class="icon-file" src="<?php echo base_url($document->avatar); ?>"/>
                            <div class="document-info">
                            <span class="title document-name">
                                <a href="<?php echo base_url("document_preview/view_detail" . "/" . $document->id); ?>"><?php echo $document->name; ?></a>
                            </span>
                                <p class="description"><?php echo $document->description; ?>
                                </p>
                                <div class="download-footer">
                                    <i class="material-icons grey-text">file_download</i>
                                    <span class="grey-text"><?php echo $document->count_downloaded; ?></span>
                                    <button class="waves-effect waves-light btn btn-download">Download</button>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php
                } ?>
            </ul>
        </div>
    </div>
</div>