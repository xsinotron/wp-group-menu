function group_menu_toogle() {
    var toggle_btn   = jQuery(".wpgroupmenu_toggle"),
        menu         = jQuery('.wpgroupmenu_nav_mobi nav.wpgroupmenu_nav');
    if ( menu.hasClass("opened") ) {
        menu.removeClass("opened").addClass("closed");
    } else {
        menu.addClass("opened").removeClass("closed"); 
    }
}
jQuery(".wpgroupmenu_toggle").on("click", group_menu_toogle);