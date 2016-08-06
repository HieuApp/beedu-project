<div class="container">
    <div class="row">
        <div class="col s12 full-width">
            <div class="row column text-center">
                <a class="group-title left"
                   href="<?php echo base_url("document/view_category") . "/" . $category->id; ?>">
                    <i class="material-icons vertical-sub">storage</i><?php echo $category->name; ?></a>
            </div>
            <ul class="col s12 collection library">
                <?php
                foreach ($document_by_category as $document) { ?>

                    <li class="collection-item document-item">
                        <div class="document-item">
                            <img class="icon-file" src="<?php echo base_url("assets/images/file.png"); ?>"/>
                            <div class="document-info">
                            <span class="title document-name">
                                <a href="<?php echo base_url("document_preview"); ?>"><?php echo $document->name; ?></a>
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