<?php

function wpgroupmenu_manageSites() {
    global $wpdb;
    if($_POST){
        if(isset($_POST['task']) && ($_POST['task'] == 'new' || $_POST['task'] == 'edit')){

            $task       = sanitize_text_field($_POST['task']);
            $siteName   = trim(sanitize_text_field($_POST['wpgm_siteName']));
            $siteUrl    = wpgroupmenu_formatURL(trim(sanitize_text_field($_POST['wpgm_siteUrl'])));
            $siteIcon   = wpgroupmenu_formatURL(trim(sanitize_text_field($_POST['wpgm_siteIcon'])));
            $siteId     = wpgroupmenu_generateKey($siteUrl);
            $siteAlt    = trim(sanitize_text_field($_POST['wpgm_siteAlt']));
            $siteTarget = trim(sanitize_text_field($_POST['wpgm_siteTarget']));
            $siteOrder  = trim(sanitize_text_field($_POST['wpgm_siteOrder']));
          //define( 'DIEONDBERROR', true );
            $wpdb->show_errors();

            $site = array(
                // siteIcon !
                'siteOrder' => $siteOrder,
                'siteName'  => $siteName,
                'siteUrl'   => $siteUrl,
                'siteIcon'  => $siteIcon,
                'siteAlt'   => $siteAlt,
                'siteTarget'=> $siteTarget,
                'siteId'    => $siteId
            );

            switch($task){
               case 'new':
                    $wpdb->insert($wpdb->base_prefix.'wpgroupmenu_sites', $site);
                  //$wpdb->print_error();
                    die();
                    break;
               case 'edit':
                   $sid   = intval($_POST['sid']);
                   $where = array('sid' => $sid);
                   $wpdb->update($wpdb->base_prefix.'wpgroupmenu_sites', $site, $where);
                 //$wpdb->print_error();
                   die();
                   break;
            }
        }
        if(isset($_POST['task']) && $_POST['task'] == 'load'){
            $sid = $_POST['sid'];
            $siteInfo = $wpdb->get_row("SELECT * FROM ".$wpdb->base_prefix."wpgroupmenu_sites WHERE sid=".$sid);
            echo json_encode($siteInfo);
            die();
        }
    }
}
function wpgroupmenu_getmenus(){
    global $wpdb;
    $sql = "SELECT * FROM ".$wpdb->base_prefix."wpgroupmenu_sites ORDER BY siteOrder ASC";
    $menus = $wpdb->get_results($sql);
    return $menus;
}

function wpgroupmenu_sitecheck($siteID){
    global $wpdb;
    $sql = "SELECT * FROM ".$wpdb->base_prefix."wpgroupmenu_sites WHERE siteId='$siteID'";
    $results = $wpdb->get_results($sql);
    $found = ($results) ? true : false;
    return $found;
}

function wpgroupmenu_clientRequest(){
    if(isset($_POST['siteID']) && $_POST['action'] == 'requestMenus'){
        if(wpgroupmenu_sitecheck($_POST['siteID'])){
            $results = array('auth' => 1, 'menus' => wpgroupmenu_getmenus());
        }
        else{
            $results = array('auth' => 0);
        }
        echo json_encode($results);
    }
    die();
}


/*
 * Use function if to much DB calls is an issue
 * Update a json file and read the file for menu calls instead of DB calls
 */
function wpgroupmenu_updateJson(){
    $menus = wpgroupmenu_getmenus();
    $menu_file = WPGROUPMENU_PLUGIN_DIR . "menus.json";
    file_put_contents($menu_file, json_encode($menus));
}
/**
 * [wpgroupmenu_formatURL description]
 * @param  [type] $url [description]
 * @return [type]      [description]
 */
function wpgroupmenu_formatURL($url){
    $regex = "@(https?://)*(www\.)*[a-zA-Z0-9-]{1,61}[\.a-zA-Z]+[\/a-zA-Z0-9-]*@";
    preg_match($regex, $url, $matches);
    if(!$matches[1]){
        $url = "http://" . $url;
    }
    if(substr($url, -1) == "/"){
        $url = substr($url, 0, -1);
    }
    return $url;
}
/**
 * [wpgroupmenu_showmenu description]
 * @return [type] [description]
 */
function wpgroupmenu_showmenu(){
    $menus = wpgroupmenu_getmenus();
    $siteID = wpgroupmenu_generateKey(get_option('siteurl'));
    include ("views/menu.php");
}
/**
 * [wpgroupmenu_generateKey description]
 * @param  [type] $url [description]
 * @return [type]      [description]
 */
function wpgroupmenu_generateKey($url){
    return md5($url);
}
/**
 * [wpgroupmenu_message description]
 * @param  [type] $message [description]
 * @return [type]          [description]
 */
function wpgroupmenu_message( $message ){
    include "views/message.php";
}
