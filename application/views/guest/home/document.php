<div class="container">
    <div class="row">
        <div class="col s12 m12 l8 offset-l2">
            <div class="row column text-center">
                <a class="group-title left"
                   href="<?php echo base_url("document/view_category") . "/" . $category->id; ?>">
                    <i class="material-icons vertical-sub">storage</i><?php echo $category->name; ?></a>
            </div>
            <ul class="collection">
                <?php
                foreach ($document_by_category as $document) { ?>

                    <li class="collection-item">
                        <div class="row no-margin-bottom">
                            <div class="col m2 s4 l2">
                                <a href="<?php echo base_url("document_preview/view_detail" . "/" . $document->id); ?>">
                                    <img class="xxicon-file" src="<?php echo base_url($document->avatar); ?>"/>
                                </a>
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
                                <div class="float-right text-right right">
                                    <div class=" btn-flat disabled">
                                        <i class="material-icons">file_download</i>
                                        <?php echo $document->count_downloaded; ?>
                                    </div>
                                    <a href="<?php echo base_url("document/download" . "/" . $document->id); ?>"
                                       class="waves-effect waves-light btn btn-download">Download
                                    </a>
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