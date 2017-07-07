<?php

class WPGroupMenu_List extends WP_List_Table {

    function __construct(){

        global $status, $page;

        //Set parent defaults
        parent::__construct( array(
            'singular'  => 'site',     //singular name of the listed records
            'plural'    => 'sites',    //plural name of the listed records
            'ajax'      => false        //does this table support ajax?
        ) );

    }

    function column_siteName($item){
        $actions = array(
            'edit'      => sprintf('<a href="javascript:wpgroupmenu_editSite(%s)">Edit</a>',$item->sid),
            'delete'    => sprintf('<a href="javascript:wpgroupmenu_delete(%s)">Delete</a>', $item->sid)
        );
        return sprintf('%1$s<span style="color:silver"></span>%2$s',$item->siteName, $this->row_actions($actions));
    }

    function column_cb($item) {
        return sprintf('<input type="checkbox" name="%1$s[]" value="%2$s" />', $this->_args['singular'], $item->sid);
    }

    function column_default( $item, $column_name ) {
        switch( $column_name ) {
          case 'siteUrl': echo $item->$column_name; break;
        //case 'siteIcon': echo $item->$column_name; break;
          case 'siteId':     echo $item->$column_name; break;
          case 'siteAlt':    echo $item->$column_name; break;
          case 'siteTarget': echo $item->$column_name; break;
          case 'siteOrder':  echo $item->$column_name; break;
        }
    }
    /**
     * Build list of option of "ordered elements"
     **/
    public function display_options () {
        global $wpdb, $_wp_column_headers;
        
        $table_name = $wpdb->base_prefix."wpgroupmenu_sites";
        $query = "SELECT * FROM  . $table_name";
        
        $totalitems = $wpdb->query($query);
        $positions = array();
        $items      = $wpdb->get_results($query, ARRAY_A);
        
        foreach ($items as $elt) {
                $positions[ $elt["siteOrder"] ] = $elt;
        }
        ksort($positions);
        
        $options = "";
        $i       = 0;
        for($i = 0; $i < $totalitems; $i++){
            $id = $i+1;
            $current_value = $positions[$id]["siteName"];
            $i_read  = ( ($i<10) ? "0$id" : "$id" ) . ( ( $current_value != "" ) ? " : $current_value" : " : <i>empty</i>");
            
            $options .= "<option value='$id'>$i_read</option>\n";
        }
        
        $id = $i+1;
        $current_value = $positions[$id]["siteName"];
        $i_read  = ( ($i<10) ? "0$id" : "$id" ) . " : <i>new</i>";
        $options .= "<option value='$id'>$i_read</option>\n";
        
        return $options;//.print_r($positions, true);
    }
    function get_columns(){
        $columns = array(
            'cb'         => '<input type="checkbox" />',
            'siteOrder'  => 'Position',
            'siteName'   => 'Site Name',
          //'siteIcon' => 'Site Icon',
            'siteAlt'    => 'Alt Text',
            'siteUrl'    => 'Site URL',
            'siteTarget' => 'target',
            'siteId'     => 'Site ID'
        );
        return $columns;
    }

    function get_sortable_columns() {
        $sortable_columns = array(
            'sid'    => array('sid',true),
        );
        return $sortable_columns;
    }

    function get_bulk_actions() {
        $actions = array(
            'delete'    => 'Delete'
        );
        return $actions;
    }

    function process_bulk_action() {
        if ( 'delete'=== $this->current_action() ) {
            foreach($_GET['site'] as $site) {
                wpgroupmenu_deleteSite($site, false);
            }
        }
    }

    function prepare_items() {
        global $wpdb, $_wp_column_headers;
	$screen = get_current_screen();
        $table_name = $wpdb->base_prefix."wpgroupmenu_sites";
        $query = "SELECT * FROM  . $table_name";
        $orderby = !empty($_GET["orderby"]) ? mysql_real_escape_string($_GET["orderby"]) : 'sid';
        $order   = !empty($_GET["order"])   ? mysql_real_escape_string($_GET["order"])   : 'desc';
        if(!empty($orderby) & !empty($order)){ $query.=' ORDER BY '.$orderby.' '.$order; }
        $totalitems = $wpdb->query($query);
        //How many to display per page?
        $perpage = 15;
        //Which page is this?
        $paged = !empty($_GET["paged"]) ? mysql_real_escape_string($_GET["paged"]) : '';
        //Page Number
        if(empty($paged) || !is_numeric($paged) || $paged<=0 ){ $paged=1; }
        //How many pages do we have in total?
        $totalpages = ceil($totalitems/$perpage);
        //adjust the query to take pagination into account
        if(!empty($paged) && !empty($perpage)){
            $offset=($paged-1)*$perpage;
            $query.=' LIMIT '.(int)$offset.','.(int)$perpage;
        }

        /* -- Register the pagination -- */
        $this->set_pagination_args(array(
            "total_items" => $totalitems,
            "total_pages" => $totalpages,
            "per_page"    => $perpage
        ));
        /* -- Register the pagination -- */
        $this->process_bulk_action();

        /* -- Fetch the items -- */
        $this->items = $wpdb->get_results($query);

        /* -- Register the Columns -- */
        $columns = $this->get_columns();
        $_wp_column_headers[$screen->id]=$columns;
        $hidden = array();
        $sortable = $this->get_sortable_columns();
        $this->_column_headers = array($columns, $hidden, $sortable);
    }

}

