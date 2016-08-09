<div id="index-banner" class="parallax-container">
    <div class="section no-pad-bot">
        <div class="container">
            <br><br>
            <h1 class="header center teal-text text-lighten-2">Beedu.vn</h1>
            <div class="row center">
                <h5 class="header col s12 light"><?php echo $introduce_title; ?></h5>
            </div>
            <div class="row center">
                <a href="<?php echo base_url("beedu_detail"); ?>" id="download-button"
                   class="btn-large waves-effect waves-light teal lighten-1">Xem thêm</a>
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
            <h4 class="menu-title header col s12 light">Phương pháp học Beedu</h4>
            <div class="col s12 m12 l12">
                <section id="cd-timeline" class="cd-container">
                    <div class="cd-timeline-block">
                        <div class="cd-timeline-img cd-picture">
                            <span class="step">1</span>
                        </div>
                        <div class="cd-timeline-content">
                            <h2 class="step-title"><?php echo $learning_method_1; ?></h2>
                            <p class="no-magin"><?php echo $learning_method_content_1; ?></p>

                        </div>
                    </div>

                    <div class="cd-timeline-block">
                        <div class="cd-timeline-img cd-movie">
                            <span class="step">2</span>
                        </div>

                        <div class="cd-timeline-content">
                            <h2 class="step-title"><?php echo $learning_method_2; ?></h2>
                            <p class="no-magin"><?php echo $learning_method_content_2; ?></p>

                        </div>
                    </div>

                    <div class="cd-timeline-block">
                        <div class="cd-timeline-img cd-picture">
                            <span class="step">3</span>
                        </div>

                        <div class="cd-timeline-content">
                            <h2 class="step-title"><?php echo $learning_method_3; ?></h2>
                            <p class="no-magin"><?php echo $learning_method_content_3; ?></p>

                        </div>
                    </div>

                    <div class="cd-timeline-block">
                        <div class="cd-timeline-img cd-location">
                            <span class="step">4</span>
                        </div>

                        <div class="cd-timeline-content">
                            <h2 class="step-title"><?php echo $learning_method_4; ?></h2>
                            <p class="no-magin"><?php echo $learning_method_content_4; ?></p>
                        </div>
                    </div>
                    <a href="<?php echo base_url("register_trial"); ?>" id="download-button"
                       class="btn-large waves-effect waves-light teal lighten-1">Đăng ký học thử</a>
                </section>
            </div>
        </div>

    </div>
</div>


<div class="parallax-container valign-wrapper">
    <div class="section no-pad-bot">
        <div class="container">
            <div class="row center">

                <h5 class="header col s12 light">Chương trình học được nghiên cứu và phát triển theo các
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
                <h4 class="header col s12 light">Chương trình học</h4>

                <div class="row">
                    <?php foreach ($classes as $class) { ?>
                        <div class="col s12 m6 l3">
                            <div class="card blue-grey darken-1">
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
                <h4 class="header col s12 light">Thư viện</h4>

                <div class="row">
                    <div class="col s12 m6 l4 medium-4 columns">
                        <h4 class="group-title">Mới nhất</h4>
                        <?php foreach ($documents as $document) { ?>
                            <div class="media-object">
                                <div class="media-object-section">
                                    <a href="<?php echo base_url("document_preview/view_detail" . "/" . $document->id); ?>">
                                        <img class="thumbnail"
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
                    <div class=" col s12 m6 l4 medium-4 columns">
                        <h4 class="group-title">Tải nhiều nhất</h4>
                        <?php foreach ($documents as $document) { ?>
                            <div class="media-object">
                                <div class="media-object-section">
                                    <a href="<?php echo base_url("document_preview/view_detail" . "/" . $document->id); ?>">
                                        <img class="thumbnail"
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
                    <div class=" col s12 m6 l4 medium-4 columns">
                        <h4 class="group-title">Chọn lọc</h4>
                        <?php foreach ($documents as $document) { ?>
                            <div class="media-object">
                                <div class="media-object-section">
                                    <a href="<?php echo base_url("document_preview/view_detail" . "/" . $document->id); ?>">
                                        <img class="thumbnail"
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
                <a href="<?php echo base_url("docs_collection"); ?>" id="download-button"
                   class="btn-large waves-effect waves-light teal lighten-1">Xem tài liệu khác</a>
            </div>
        </div>
    </div>
    <div class="parallax"><img src="<?php echo base_url($library); ?>"
                               alt="Unsplashed background img 3"></div>
</div>

<div class="secsion section-question" id="answer_question">
    <div class="row ">
        <div class="col s12 center">
            <h4 class="header col s12 light">Hỏi đáp</h4>
            <ul class="col s12 m4 l6 offset-l3 collapsible with-header question-support"
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
                                    class="btn-large waves-effect waves-light teal lighten-1">Gửi
                            </button>
                            <div id="snackbar">Some text some message..</div>
                        </form>
                    </div>

                </li>

            </ul>
        </div>
    </div>
</div>
