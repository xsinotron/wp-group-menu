<?php
defined('ABSPATH') or die("ERROR: You do not have permission to access this page");
function wpgroupmenu_save_option($option) {
    if ($_POST['options'][$option]) {
        if (get_option($option)) {
            update_option($option, $_POST['options'][$option]);
        } else {
            add_option($option, $_POST['options'][$option]);
        }
    }
}
if ($_POST) {
    foreach ($_POST['options'] as $option => $value) {
        wpgroupmenu_save_option($option);
    }
    ?>
        <div id="message" class="updated fade"><p><strong><?=__('Configurations saved','wgm');?></strong></p></div>
    <?php
}
?>
<div class="metabox-holder">
    <div id="post-body">
        <div id="post-body-content">
            <div class="postarea">
                <div class="postbox">
                    <h3><?=__('Settings','wgm');?></h3>
                    <div class="inside">
                        <form method="post" action="<?=$_SERVER['REQUEST_URI'];?>">
                            <table class="form-table">
                                <tr>
                                    <th>
                                        <label for="options[wpgroupmenu_css]"><?=__('Choose Menu Style','wgm');?></label></th>
                                    <td>
                                        <select name="options[wpgroupmenu_css]" id="wpgm_css_selector" onchange="wpgroupmenu_loadCssPreview('<?=plugins_url('wp-group-menu').'/images/previews/'; ?>', this);">
                                            <?php
                                            require WPGROUPMENU_PLUGIN_DIR .'wpgroupmenu_themes.php';
                                            $themes = new WPGroupMenu_Theme();
                                            ?>
                                            <?php foreach ($themes->list as $color => $name) : ?>
                                            <option value="<?=$color;?>" <?php selected(get_option('wpgroupmenu_css'), $color);?>><?=$name;?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <span id='wpgm_css_image'>
                                            <img src="<?=plugins_url('wp-group-menu').'/images/previews/'.get_option('wpgroupmenu_css').'.png'; ?>" alt="<?=__('Menu Preview','wgm');?>">
                                        </span>
                                    </td>
                                </tr>
                            </table>
                            <input type="submit" name="Submit" class="button-primary" value="<?=__('Save','wgm');?>" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
