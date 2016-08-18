<div class="navbar-fixed">
    <nav class="grey darken-3 override">
        <div class="nav-wrapper">
            <a id="logo-container" href="<?php echo base_url("home"); ?>" class="brand-logo">BEEDU.VN</a>
            <a href="#" data-activates="mobile-demo" class="button-collapse white-text"><i
                    class="white-text material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
                <li class="search-box">
                    <form id="form-search" action="<?php echo base_url("document/search"); ?>" method="POST"
                          enctype="multipart/form-data" role="form">
                        <div class="input-field">
                            <input name="key" id="search" type="search" placeholder="Tìm kiếm đề thi, tài liệu..."
                                   required>
                            <i class="material-icons ">search</i>
                        </div>
                    </form>
                </li>
                <li class="menu"><a href="<?php echo base_url("home#edu_method"); ?>"
                                    id="edu-method"><?php echo $menu_1; ?></a></li>
                <li class="menu"><a href="<?php echo base_url("home#edu_program"); ?>"
                                    id="edu-program"><?php echo $menu_2; ?></a>
                </li>
                <li class="menu"><a href="<?php echo base_url("home#answer_question"); ?>"
                                    id="answer-question"><?php echo $menu_4; ?></a></li>
                <li class="menu"><a href="<?php echo base_url("home#intro_beedu"); ?>"
                                    id="intro-beedu"><?php echo $menu_5; ?></a>
                </li>
            </ul>
            <ul class="side-nav" id="mobile-demo">
                <li class="search-box">
                    <form action="<?php echo base_url("document/search"); ?>" method="POST"
                          enctype="multipart/form-data" role="form">
                        <div class="input-field">
                            <input name="key" type="search" placeholder="Tìm kiếm đề thi, tài liệu..." required>
                            <label for="search"><i class="material-icons">search</i></label>
                            <i class="material-icons">close</i>
                        </div>
                    </form>
                </li>
                <li><a href="<?php echo base_url("home#edu_method"); ?>" id="edu-method"><?php echo $menu_1; ?></a></li>
                <li><a href="<?php echo base_url("home#edu_program"); ?>" id="edu-program"><?php echo $menu_2; ?></a>
                </li>
                <li><a href="<?php echo base_url("home#edu_library"); ?>" id="edu-library"><?php echo $menu_3; ?></a>
                </li>
                <li><a href="<?php echo base_url("home#answer_question"); ?>"
                       id="answer-question"><?php echo $menu_4; ?></a></li>
                <li><a href="<?php echo base_url("home#intro_beedu"); ?>" id="intro-beedu"><?php echo $menu_5; ?></a>
                </li>
            </ul>
        </div>
    </nav>
</div>