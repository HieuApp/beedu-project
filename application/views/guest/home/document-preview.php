<div class="container">
    <div class="row">
        <div class="content-preview">
            <div class="col s12 m6 l8 content-padding">
                <h4 class="light document-name left"><b><?php echo $document->name; ?></b></h4>
                <p class="description left"><?php echo $document->description; ?>
                </p>
            </div>
            <div class="col s12 m4 l8">
                <iframe
                    src="http://docs.google.com/gview?url=http://infolab.stanford.edu/pub/papers/google.pdf&embedded=true"
                    style="width:700px; height:500px;" frameborder="0"></iframe>
            </div>
            <div class="col s12 m4 l4">
                <div class="collection">
                    <h5 class="collection-item">Tài liệu liên quan</h5>
                    <?php foreach ($document_by_category as $document) { ?>
                        <a href="<?php echo base_url("document_preview/view_detail" . "/" . $document->id); ?>"
                           class="collection-item link-docs left"><?php echo $document->name; ?></a>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="download-footer content-padding">
            <i class="material-icons grey-text">file_download</i>
            <span class="grey-text"><?php echo $document->count_downloaded; ?></span>
            <a href="<?php echo base_url("document/download" . "/" . $document->id); ?>"
                    class="waves-effect waves-light btn btn-download">Download
            </a>
        </div>
    </div>
</div>