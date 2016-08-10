<div class="container">
    <div class="row">
        <div class="col s12 m12 l8 offset-l2">
            <ul class="collection">
                <?php
                foreach ($document_by_category as $document) { ?>

                    <li class="collection-item">
                        <div class="row">
                            <div class="col m2 s4 l2">
                                <img class="xxxx" src="<?php echo base_url($document->avatar); ?>"/>
                            </div>
                            <div class="col m10 s8 l10">
                                <div class="document-info">
                                <span class="title document-name">
                                    <a href="<?php echo base_url("document_preview/view_detail" . "/" . $document->id); ?>"><?php echo $document->name; ?></a>
                                </span>
                                    <p class="description"><?php echo $document->description; ?>
                                    </p>
                                </div>
                            </div>
                            <div class="col s12 m12 l12">
                                <div class="float-right text-right">
                                    <div class=" btn-flat disabled">
                                        <i class="material-icons">file_download</i>
                                        <?php echo $document->count_downloaded; ?>
                                    </div>
                                    <a href="<?php echo base_url("document/download" . "/" . $document->id); ?>"
                                       class="waves-effect waves-light btn">Download
                                    </a>
                                </div>
                            </div>
                            <!--                        <div class="download-footer">-->
                            <!--                            <i class="material-icons grey-text">file_download</i>-->
                            <!--                            <span class="grey-text">-->
                            <?php //echo $document->count_downloaded; ?><!--</span>-->
                            <!--                            <button class="waves-effect waves-light btn btn-download">Download</button>-->
                            <!--                        </div>-->
                        </div>
                    </li>
                    <?php
                } ?>
            </ul>
        </div>
    </div>
</div>