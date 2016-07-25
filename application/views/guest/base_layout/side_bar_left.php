<script type="text/javascript">
    try {
        ace.settings.check('sidebar', 'fixed')
    } catch (e) {
    }
</script>
<!-- .sidebar-shortcuts -->
<div class="sidebar-shortcuts hidden" id="sidebar-shortcuts">
    <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
        <button class="btn btn-success">
            <i class="ace-icon fa fa-signal"></i>
        </button>

        <button class="btn btn-info">
            <i class="ace-icon fa fa-pencil"></i>
        </button>

        <button class="btn btn-warning">
            <i class="ace-icon fa fa-users"></i>
        </button>

        <button class="btn btn-danger">
            <i class="ace-icon fa fa-cogs"></i>
        </button>
    </div>

    <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
        <span class="btn btn-success"></span>

        <span class="btn btn-info"></span>

        <span class="btn btn-warning"></span>

        <span class="btn btn-danger"></span>
    </div>
</div><!-- /.sidebar-shortcuts -->

<!-- .nav-list -->
<ul class="nav nav-list">
    <?php function renderCategory($categoryList) { ?>
        <?php foreach ($categoryList as $item) { ?>
            <li>
                <a class="<?php echo isset($item["class"]) ? $item["class"] : ''; ?>"
                   href="<?php echo (!isset($item["child"]) || !$item["child"] || !count($item["child"])) ? $item["url"] : "#"; ?>"
                   title="<?php echo $item["text"] ?>">
                    <i class="menu-icon fa  <?php echo $item["icon"] ?>"></i>
                    <span class='menu-text'><?php echo $item["text"] ?></span>
                </a><b class='arrow'></b>
                <?php if (isset($item["child"]) && $item["child"] && count($item["child"]) > 0) {
                    echo '<ul class="submenu">';
                    renderCategory($item["child"]);
                    echo '</ul>';
                 } ?>
            </li>
        <?php }
    } ?>
    <?php renderCategory($menu_data); ?>
</ul><!-- /.nav-list -->
<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
    <i class="ace-icon fa fa-angle-double-left"
       data-icon1="ace-icon fa fa-angle-double-left"
       data-icon2="ace-icon fa fa-angle-double-right"></i>
</div>

<script type="text/javascript">
    try {
        ace.settings.check('sidebar', 'collapsed');
    } catch (e) {

    }
</script>