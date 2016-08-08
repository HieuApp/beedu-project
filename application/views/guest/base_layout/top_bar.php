<nav class="black" role="navigation">
    <div class="nav-wrapper container">
        <a id="logo-container" href="<?php echo base_url("home"); ?>" class="brand-logo">BEEDU.VN</a>
        <div class="input-field" style="position: absolute; height: 35px; background: white;
            left: 220px; margin-top: 15px; width: 300px;">

            <input id="search" type="search" style="color: black;"
                   placeholder="Tìm kiếm đề thi, tài liệu..."/>
            <i class="material-icons" style="color: black; right: 0;">search</i>
        </div>
        <ul class="right hide-on-med-and-down">
            <li><a href="<?php echo base_url("home#edu_method");?>" id="edu-method"><?php echo $menu_1; ?></a></li>
            <li><a href="<?php echo base_url("home#edu_program");?>" id="edu-program"><?php echo $menu_2; ?></a></li>
            <li><a href="<?php echo base_url("home#edu_library");?>" id="edu-library"><?php echo $menu_3; ?></a></li>
            <li><a href="<?php echo base_url("home#answer_question");?>" id="answer-question"><?php echo $menu_4; ?></a></li>
            <li><a href="<?php echo base_url("home#intro_beedu");?>" id="intro-beedu"><?php echo $menu_5; ?></a></li>
        </ul>
        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
</nav>