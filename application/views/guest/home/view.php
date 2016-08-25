<div id="index-banner" class="parallax-container valign-wrapper bg-hight">
    <div class="section no-pad-bot ">
        <div class="container">
            <div class="row valign-wrapper">
                <div class="col s12 m4 l7 center bottom-20">
                    <h5 class="header grey-text text-darken-3 font-40"><?php echo $introduce_title; ?></h5>
                    <a href="<?php echo base_url("beedu_detail"); ?>" id="download-button"
                       class="btn-large waves-effect waves-light blue">Xem thêm</a>
                </div>

                <div class="col s12 m4 l5 center">
                    <iframe width="420" height="240" class="video-border"
                            src="https://www.youtube.com/embed/1mHjMNZZvFo?autoplay=1" frameborder="0" allowfullscreen></iframe>
                </div>

            </div>

        </div>
    </div>

    <div class="parallax"><img src="<?php echo base_url($img_bg_intro); ?>"
                               alt="Unsplashed background img 1"></div>

</div>


<div class="container" id="edu_method">
    <div class="section section-method">
        <!--   Icon Section   -->
        <div class="row">
            <h4 class="menu-title header col s12 light center menu-font">Giá trị của Beedu</h4>
            <div class="col s12 m12 l12">
                <section id="cd-timeline" class="cd-container">
                    <div class="cd-timeline-block">
                        <div class="cd-timeline-img cd-picture center" id="step-1">
                            <span class="step">1</span>
                        </div>
                        <div class="cd-timeline-content z-depth-1">
                            <h2 id="method-1" class="step-title "><b><?php echo $learning_method_1; ?></b></h2>
                            <p class="no-magin grey-text text-darken-3" >
                                <?php echo $learning_method_content_1 . "..."; ?>
                                <a href="<?php echo base_url("method_detail_1");?>">Xem thêm</a>
                            </p>

                        </div>
                    </div>

                    <div class="cd-timeline-block">
                        <div class="cd-timeline-img cd-picture center" id="step-2">
                            <span class="step">2</span>
                        </div>

                        <div class="cd-timeline-content z-depth-1">
                            <h2 id="method-2" class="step-title "><b><?php echo $learning_method_2; ?></b></h2>
                            <p class="no-magin grey-text text-darken-3">
                                <?php echo $learning_method_content_2 . "..."; ?>
                                <a href="<?php echo base_url("method_detail_2");?>">Xem thêm</a>
                            </p>

                        </div>
                    </div>

                    <div class="cd-timeline-block">
                        <div class="cd-timeline-img cd-picture center" id="step-3">
                            <span class="step">3</span>
                        </div>

                        <div class="cd-timeline-content z-depth-1 ">
                            <h2 id="method-3" class="step-title "><b><?php echo $learning_method_3; ?></b></h2>
                            <p class="no-magin grey-text text-darken-3">
                                <?php echo $learning_method_content_3 . "..."; ?>
                                <a href="<?php echo base_url("method_detail_3");?>">Xem thêm</a>
                            </p>

                        </div>
                    </div>

                    <div class="cd-timeline-block">
                        <div class="cd-timeline-img cd-picture center" id="step-4">
                            <span class=" step">4</span>
                        </div>

                        <div class="cd-timeline-content z-depth-1 ">
                            <h2 id="method-4" class="step-title "><b><?php echo $learning_method_4; ?></b></h2>
                            <p class="no-magin grey-text text-darken-3">
                                <?php echo $learning_method_content_4 . "..."; ?>
                                <a href="<?php echo base_url("method_detail_4");?>">Xem thêm</a>
                            </p>
                        </div>
                    </div>
                    <div class="center">
                        <a href="<?php echo base_url("register_trial"); ?>" id="download-button"
                           class="btn-large waves-effect waves-light blue">Đăng ký học thử</a>
                    </div>
                </section>
            </div>
        </div>

    </div>
</div>


<div class="parallax-container valign-wrapper">
    <div class="section no-pad-bot">
        <div class="container">
            <div class="row center">

                <h5 class="header col s12 grey-text text-darken-3 font-30">Chương trình học được nghiên cứu và phát triển theo các
                    nền giáo dục hàng đầu thế giới</h5>
            </div>
        </div>
    </div>
    <div class="parallax"><img src="<?php echo base_url($student_class); ?>"
                               alt="Unsplashed background img 2"></div>

</div>

<div class="container" id="edu_program">
    <div class="section section-program">
        <div>
            <div class="col s12 m12 l12 center">
                <h4 class="header col s12 light menu-font">Chương trình học</h4>

                <div class="row">
                    <?php $count = 1;?>
                    <?php foreach ($classes as $class) { ?>
                        <div class="col s12 m6 l3">
                            <div class="card blue-grey lighten-1" id="program-<?php echo $count;?>">
                                <div class="card-image">
                                    <img class="card-img-content"
                                         src="<?php echo base_url($class->avatar); ?>">
                                    <div class="transfer-box">

                                    </div>
                                    <span class="card-title"><?php echo $class->name; ?></span>
                                </div>
                                <div class="card-content white-text">
                                    <p><?php echo $class->description; ?></p>
                                    <p><?php echo $class->price; ?></p>
                                </div>
                                <div class="card-action">
                                    <a href="<?php echo base_url("register_trial"); ?>">Học thử miễn phí</a>
                                </div>
                            </div>
                        </div>
                        <?php $count = $count + 1;?>
                    <?php } ?>
                </div>

            </div>
        </div>
    </div>

</div>
</div>
<div class="parallax-container valign-wrapper">
    <div class="container section-library" id="edu_library">
        <div class="secsion">
            <div class="row">
                <h4 class="header col s12 white-text center menu-font">Thư viện</h4>

                <div class="row">
                    <div class="col s12 m6 l4 medium-4 columns center">
                        <h4 class="group-title white-text font-30">Mới nhất</h4>
                        <?php foreach ($documents_newest as $document) { ?>
                            <div class="media-object card">
                                <div class="media-object-section">
                                    <a href="<?php echo base_url("document_preview/view_detail" . "/" . $document->id); ?>">
                                        <img class="thumbnail icon-file"
                                             src="<?php echo base_url($document->avatar); ?>">
                                    </a>
                                </div>
                                <div class="media-object-section">
                                    <h5 class="document-title black-text left-align">
                                        <a href="<?php echo base_url("document_preview/view_detail" . "/" . $document->id); ?>"><?php echo $document->name; ?></a>
                                    </h5>
                                    <p class="description black-text left-align">
                                        <?php
                                        $max_length = 105;
                                        $text = $document->description;
                                        if (strlen($document->description) > $max_length) {
                                            $text = substr($document->description, 0, $max_length) . "...";
                                        }
                                        echo $text; ?>
                                    </p>
                                </div>
                            </div>
                            <?php
                        } ?>
                    </div>
                    <div class=" col s12 m6 l4 medium-4 columns center">
                        <h4 class="group-title  white-text font-30">Hay nhất</h4>
                        <?php foreach ($documents_hotest as $document) { ?>
                            <div class="media-object card">
                                <div class="media-object-section">
                                    <a href="<?php echo base_url("document_preview/view_detail" . "/" . $document->id); ?>">
                                        <img class="thumbnail icon-file"
                                             src="<?php echo base_url($document->avatar); ?>">
                                    </a>
                                </div>
                                <div class="media-object-section">
                                    <h5 class="document-title black-text left-align">
                                        <a href="<?php echo base_url("document_preview/view_detail" . "/" . $document->id); ?>"><?php echo $document->name; ?></a>
                                    </h5>
                                    <p class="description black-text left-align">
                                        <?php
                                        $max_length = 105;
                                        $text = $document->description;
                                        if (strlen($document->description) > $max_length) {
                                            $text = substr($document->description, 0, $max_length) . "...";
                                        }
                                        echo $text; ?>
                                    </p>
                                </div>
                            </div>
                            <?php
                        } ?>
                    </div>
                    <div class=" col s12 m6 l4 medium-4 columns center">
                        <h4 class="group-title  white-text font-30">Độc nhất</h4>
                        <?php foreach ($documents_special as $document) { ?>
                            <div class="media-object card">
                                <div class="media-object-section">
                                    <a href="<?php echo base_url("document_preview/view_detail" . "/" . $document->id); ?>">
                                        <img class="thumbnail icon-file"
                                             src="<?php echo base_url($document->avatar); ?>">
                                    </a>
                                </div>
                                <div class="media-object-section">
                                    <h5 class="document-title black-text left-align">
                                        <a href="<?php echo base_url("document_preview/view_detail" . "/" . $document->id); ?>"><?php echo $document->name; ?></a>
                                    </h5>
                                    <p class="description black-text left-align">
                                        <?php
                                        $max_length = 105;
                                        $text = $document->description;
                                        if (strlen($document->description) > $max_length) {
                                            $text = substr($document->description, 0, $max_length) . "...";
                                        }
                                        echo $text; ?>
                                    </p>
                                </div>
                            </div>
                            <?php
                        } ?>
                    </div>
                </div>
                <div class="center">
                    <a href="<?php echo base_url("docs_collection"); ?>" id="download-button"
                       class="btn-large waves-effect waves-light blue">Xem tài liệu khác</a>
                </div>

            </div>
        </div>
    </div>
    <div class="parallax"><img src="<?php echo base_url($library); ?>"
                               alt="Unsplashed background img 3"></div>
</div>

<div class="secsion section-question" id="answer_question">
    <div class="row ">
        <div class="col s12 center">
            <h4 class="header col s12 light menu-font">Hỏi đáp</h4>
            <ul class="col s12 m8 offset-m2 l6 offset-l3 collapsible with-header question-support"
                data-collapsible="accordion">
                <?php foreach ($questions as $question) {
                    ?>
                    <li class="collection-item">
                        <div class="question collapsible-header"><?php echo $question->question; ?>
                            <a class="secondary-content">
                                <i class="material-icons expand-more">expand_more</i>
                            </a>
                        </div>
                        <div class="answer collapsible-body">
                            <p><?php echo $question->answer; ?></p>
                        </div>
                    </li>
                    <?php
                }
                ?>
                <li class="collection-item question-form">
                    <div class="row form-questrion">
                        <form class="col s12" id="feedback-form" action="<?php echo $save_link; ?>" method="POST"
                              enctype="multipart/form-data" role="form">
                            <div class="row">
                                <div class="input-field col s12 s6">
                                <textarea id="textarea1" class="materialize-textarea"
                                          name="feedback_content"></textarea>
                                    <label for="textarea1">Câu hỏi của bạn</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 s6">
                                    <input id="email" type="email" class="validate" name="email_reader">
                                    <label class="label-form" for="email">Email</label>
                                </div>
                            </div>
                            <button type="submit" id="send-feedback"
                                    class="btn waves-effect waves-light blue">Gửi
                            </button>
                            <div id="snackbar">Some text some message..</div>
                        </form>
                    </div>

                </li>

            </ul>
        </div>
    </div>
</div>
