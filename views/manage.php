<?php
if(!class_exists('WPGroupMenu_List')){
    require_once( WPGROUPMENU_PLUGIN_DIR . 'wpgroupmenu_class.php' );
}
if(is_admin() && isset($_GET['tab']) && $_GET['tab']=="manage"){
    if(isset($_GET["task"])){
        $task = sanitize_text_field($_GET["task"]);
        switch($task){
            case 'delete':
                wpgroupmenu_deleteSite($_GET['id'], true);
                wpgroupmenu_showSites();
                break;
        }
    }else{
        wpgroupmenu_showSites();
    }
}

function wpgroupmenu_deleteSite($id, $message){
    global $wpdb;
    $wpdb->show_errors();
    $sid = intval($id);
    if(current_user_can(WPGROUPMENU_ACCESS_LEVEL)){
        $siteName = $wpdb->get_row("SELECT siteName FROM ".$wpdb->base_prefix."wpgroupmenu_sites WHERE sid=".$sid);
        $wpdb->query("delete FROM ".$wpdb->base_prefix."wpgroupmenu_sites WHERE sid=".$sid);
        //wpgroupmenu_updateJson();
    }else{
        wpgroupmenu_message( __("You do not have permission to delete this entry", "wgm") );
    }
    if($message){
        wpgroupmenu_message( '"' . $siteName->siteName . '" ' . __("was successfully deleted", "wgm") );
    }
}

function wpgroupmenu_showSites(){
    ?>
    <h2>
        <?=__('Sites','wgm');?>
        <input type="button" class="button-primary" id="wpgm_addSite" value="<?=__('Add Site','wgm');?>" onclick="wpgroupmenu_addSite()">
    </h2>
    <div id="dialog-form" class="hidden">
        <form>
            <fieldset>
                <p class="validateTips hidden"><?=__('Enter the name and URL of the site.','wgm');?></p>
                <label for="siteName"><?=__('Site Name','wgm');?> <span title="<?=__('required','wgm');?>">*</span></label>
                <input type="text" name="siteName" id="siteName" class="text ui-widget-content ui-corner-all">
                <label for="siteUrl"><?=__('Site URL','wgm');?> <span title="<?=__('required','wgm');?>">*</span></label>
                <input type="text" name="siteUrl" id="siteUrl" class="text ui-widget-content ui-corner-all">
                <label for="siteAlt"><?=__('Site Alt','wgm');?></label>
                <input type="text" name="siteAlt" id="siteAlt" class="text ui-widget-content ui-corner-all">
                <label for="siteIcon"><?=__('Site Icon','wgm');?></label>
                <?php /*include("icons.html");*/?>
                <input type="text" name="siteIcon" id="siteIcon" class="text ui-widget-content ui-corner-all">
                <label for="siteTarget"><?=__('Site Target','wgm');?></label>
                <select name="siteTarget" id="siteTarget">
                    <option value=""     ><?=__('Same page','wgm');?></option>
                    <option value="blank"><?=__('New page','wgm');?></option>
                </select>
                <label for="siteOrder"><?=__('Site Order','wgm');?></label>
                <select name="siteOrder" id="siteOrder">
                    <option value="" disabled selected >-- <?=__('Choose a position','wgm');?></option>
                    <?php
                        $showPositions = new WPGroupMenu_List();
                        $showPositions->prepare_items();
                        echo $showPositions->display_options();
                    ?>
                </select>
            </fieldset>
        </form>
    </div>
    <form id="showSites" method="get">
        <input type="hidden" name="page" value="wpgroupmenu" />
        <input type="hidden" name="tab" value="manage" />
           <?php
                $showSites = new WPGroupMenu_List();
                $showSites->prepare_items();
                $showSites->display();
            ?>
    </form>
    <div class="ajax_loader"></div>
    <?php
    include "dialog.php";
}
