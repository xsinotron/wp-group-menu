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
        <div id="message" class="updated fade"><p><strong>Configurations saved</strong></p></div>
    <?php
}
?>
<div class="metabox-holder">
    <div id="post-body">
        <div id="post-body-content">
            <div class="postarea">
                <div class="postbox">
                    <h3>Settings</h3>
                    <div class="inside">
                        <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                            <table class="form-table">
                                <tr>
                                    <th><label for="options[wpgroupmenu_css]">Choose Menu Style</label></th>
                                    <td><select name="options[wpgroupmenu_css]" id="wpgm_css_selector" onchange="wpgroupmenu_loadCssPreview('<?php echo plugins_url('images/', __FILE__); ?>', this);">
                                            <option value="ymaa"     <?php selected(get_option('wpgroupmenu_css'), 'ymaa'    ); ?> >YMAA</option>
                                            <option value="sapphire" <?php selected(get_option('wpgroupmenu_css'), 'sapphire'); ?> >Sapphire</option>
                                            <option value="emerald"  <?php selected(get_option('wpgroupmenu_css'), 'emerald' ); ?> >Emerald</option>
                                            <option value="black"    <?php selected(get_option('wpgroupmenu_css'), 'black'   ); ?> >Black</option>
                                            <option value="blue"     <?php selected(get_option('wpgroupmenu_css'), 'blue'    ); ?> >Blue</option>
                                            <option value="cyan"     <?php selected(get_option('wpgroupmenu_css'), 'cyan'    ); ?> >Cyan</option>
                                            <option value="green"    <?php selected(get_option('wpgroupmenu_css'), 'green'   ); ?> >Green</option>
                                            <option value="orange"   <?php selected(get_option('wpgroupmenu_css'), 'orange'  ); ?> >Orange</option>
                                            <option value="red"      <?php selected(get_option('wpgroupmenu_css'), 'red'     ); ?> >Red</option>
                                            <option value="white"    <?php selected(get_option('wpgroupmenu_css'), 'white'   ); ?> >White</option>
                                            <option value="yellow"   <?php selected(get_option('wpgroupmenu_css'), 'yellow'  ); ?> >Yellow</option>
                                        </select>
                                        <span id='wpgm_css_image'>
                                            <img src="<?php echo plugins_url('images/previews/'.get_option('wpgroupmenu_css') .'.png', __FILE__); ?>" alt="Menu Preview">
                                        </span>
                                    </td>
                                </tr>
                            </table>
                            <input type="submit" name="Submit" class="button-primary" value="Save" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>