<?php
/*
Plugin Name: WP Group Menu
Plugin URI: http://wpgm.vspider.com
Description: Adds a universal topmenu amoung sister websites. Manage menus from one central location and use the client plugin on remaining sites.
Version: 0.3
Author: Kevon Adonis
Author URI: http://www.kevonadonis.com
*/

defined('ABSPATH') or die("ERROR: You do not have permission to access this page");
define('WPGROUPMENU_ACCESS_LEVEL', 'manage_options');
define('WPGROUPMENU_PLUGIN_DIR', dirname(__FILE__).'/');
define('WPGROUPMENU_VERSION', "0.3");
define('WPGROUPMENU_JSON', WPGROUPMENU_PLUGIN_DIR . 'menus.json');
add_action('init', 'wpgroupmenu_functions');
add_action('wp_ajax_submit_site', 'wpgroupmenu_manageSites');
add_action('admin_menu', 'register_wpgroupmenu_menu');
add_action('wp_head', 'wpgroupmenu_front_util');
add_filter('wp_head', 'wpgroupmenu_showmenu');
register_activation_hook(__FILE__,'wpgroupmenu_install');
register_activation_hook(__FILE__,'wpgroupmenu_initialize');


function register_wpgroupmenu_menu(){
    // MENU
    add_menu_page(
        'WP Group Menu',                           // page title
        'WP Group Menu',                           // menu title
        'manage_options',                          // capability
        'wpgroupmenu',                             // menu slug
        'wpgroupmenu_dashboard',                   // function to call to output the content
        plugins_url( 'images/icon.png', __FILE__), // icon url
        99                                         //position
    );
    // SUB-MENUS
        add_submenu_page(
            'wpgroupmenu',                         // parent slug
            'Manage Menus',                        // page title
            'Manage Menus',                        // menu title
            'manage_options',                      // capability
            'admin.php?page=wpgroupmenu&tab=manage'// menu slug
        );
        add_submenu_page(
            'wpgroupmenu',
            'Settings',
            'Settings',
            'manage_options',
            'admin.php?page=wpgroupmenu&tab=settings'
        );
        add_submenu_page(
            'wpgroupmenu',
            'User Guide',
            'User Guide',
            'manage_options',
            'admin.php?page=wpgroupmenu&tab=userguide'
        );
    remove_submenu_page('wpgroupmenu','wpgroupmenu');
}

global $pagenow;
if ('admin.php' == $pagenow && isset($_GET['page']) && ($_GET['page'] == 'wpgroupmenu')){
       add_action('admin_head', 'wpgroupmenu_admin_util');
} else add_action('admin_head', 'wpgroupmenu_admin_util');

/*
 * Displays the tabs and manages tabs to be displayed
 */
function wpgroupmenu_dashboard() {
    wpgroupmenu_admin_header();
    global $pagenow;
    if ( isset ( $_GET['tab'] ) ) {
        wpgroupmenu_admin_tabs($_GET['tab']);
    }else {
        wpgroupmenu_admin_tabs('manage');
    }
    if ( $pagenow == 'admin.php' && $_GET['page'] == 'wpgroupmenu' ){
        if ( isset ( $_GET['tab'] ) ) {
            $tab = $_GET['tab'];
        }
        else {
                $tab = 'manage';
            }
            switch ( $tab ){
                case 'manage' :
                    include 'wpgroupmenu_manage.php';
                    break;
            case 'settings' :
                    include 'wpgroupmenu_settings.php';
                    break;
                case 'userguide' :
                    include 'wpgroupmenu_userguide.php';
                    break;
                default:
                    include 'wpgroupmenu_manage.php';
        }
    }
}

function wpgroupmenu_admin_tabs( $current = 'manage' ) {
    $tabs = array( 'manage' => 'Manage', 'settings' => 'Settings', 'userguide' => 'User Guide');
    echo '<div id="icon-themes" class="icon32"><br></div>';
    echo '<h2 class="nav-tab-wrapper">';
    foreach( $tabs as $tab => $name ){
        $class = ( $tab == $current ) ? ' nav-tab-active' : '';
        echo "<a class='nav-tab$class' href='?page=wpgroupmenu&tab=$tab'>$name</a>";
    }
    echo '</h2>';
}

function wpgroupmenu_admin_header(){ ?>
<div class="wrap">
    <h2>
        <a href="?page=wpgroupmenu&tab=manage"><img src="<?php echo plugins_url('images/admin_logo.png', __FILE__)?>"></a>
        <span style="vertical-align: top; font-size: 11px; color: #473214;"><?php echo "Version " . WPGROUPMENU_VERSION; ?></span>
    </h2>
    <div class="alignright">Need help? <input class="button-primary" type="button" value="Support" onclick="window.open('http://www.vspider.com/support')"/></div>
<?php
}

function wpgroupmenu_functions(){
    include( WPGROUPMENU_PLUGIN_DIR . 'wpgroupmenu_functions.php' );
}


function wpgroupmenu_admin_util() {
    global $wp_scripts;
    wp_enqueue_script( 'admin_scripts', plugins_url('js/admin.js'     , __FILE__), array( 'jquery' ));
    wp_localize_script( 'ajax_scripts', 'front_ajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
    wp_enqueue_style( 'style', plugins_url('css/admin.css', __FILE__) );
    wp_enqueue_style( 'font_awesome', plugins_url('vendor/font-awesome-4.7.0/css/font-awesome.min.css', __FILE__) );
    wp_enqueue_script( 'jquery-ui' );
    $ui = $wp_scripts->query('jquery-ui-core');
    $url = "http://code.jquery.com/ui/{$ui->ver}/themes/smoothness/jquery-ui.css";
    wp_enqueue_style('jquery-ui-core', $url, false, $ui->ver);
    wp_enqueue_script( 'jquery-ui-dialog' );
}

function wpgroupmenu_front_util() {
    $style = get_option('wpgroupmenu_css');
  //wp_enqueue_script( 'scripts'   , plugins_url('js/scripts.js', __FILE__), array( 'jquery' ));
    wp_enqueue_script( 'menu_scripts' , plugins_url('js/group-menu.js', __FILE__), array( 'jquery' ));
    wp_enqueue_style( 'font_awesome', plugins_url('vendor/font-awesome-4.7.0/css/font-awesome.min.css', __FILE__) );
    wp_enqueue_style ( 'menu_style', plugins_url('css/ymaa.css' , __FILE__)                   );
}

function wpgroupmenu_install() {
   global $wpdb;
   require_once(ABSPATH.'wp-admin/includes/upgrade.php');
   $table_name = $wpdb->base_prefix."wpgroupmenu_sites";
   $sql = "CREATE TABLE $table_name (".
          "sid int(11) UNSIGNED NOT NULL AUTO_INCREMENT, ".// Identifiant unique
          "siteName varchar(55), ".                        // Nom affiché
          "siteUrl varchar(255), ".                        // URL de destination
          "siteIcon varchar(255), ".                       // URL du site
          "siteId varchar(55), ".                          // Identifiant
          "siteAlt varchar(255), ".                        // Titre de la balise html
          "siteTarget varchar(55), ".                      // mode d'ouverture du lien : blank, same
          "siteOrder int(11), ".                           // disposition dans la liste des liens
          "PRIMARY KEY (sid));";
    dbDelta($sql);
    add_option("wpgroupmenu_version", WPGROUPMENU_VERSION);
    add_option("wpgroupmenu_css", 'ymaa');

}

function wpgroupmenu_initialize(){
    global $wpdb;
    $siteName = get_bloginfo('name');
    $siteUrl = home_url();
    $siteId = md5(home_url());
    $siteAlt = get_bloginfo('description');
    $site = array(
        'siteName'   => $siteName,
        'siteUrl'    => $siteUrl,
        'siteId'     => $siteId,
        'siteAlt'    => $siteAlt,
        'siteTarget' => $siteTarget,
        'siteOrder'  => $siteOrder
    );
    $wpdb->insert($wpdb->base_prefix.'wpgroupmenu_sites', $site);
}
