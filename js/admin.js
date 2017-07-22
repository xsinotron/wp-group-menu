
function updateTips( t ) {
    tips.text( t ).addClass( "ui-state-highlight" );
    setTimeout(function() {
        tips.removeClass( "ui-state-highlight", 1500 );
    }, 500 );
}

function checkLength( entry, field, min, max ) {
    if ( entry.val().length > max || entry.val().length < min ) {
        entry.addClass( "ui-state-error" );
        updateTips( "Length of " + field + " must be between " + min + " and " + max + "." );
        return false;
    } else {
        return true;
    }
}

function checkRegexp( o, regexp, n ) {
    if ( !( regexp.test( o.val() ) ) ) {
        o.addClass( "ui-state-error" );
        updateTips( n );
        return false;
    }else {
        return true;
    }
}

function wpgroupmenu_addSite(){
    var siteName   = jQuery( "#siteName"   ),
        siteUrl    = jQuery( "#siteUrl"    ),
        siteAlt    = jQuery( "#siteAlt"    ),
        siteTarget = jQuery( "#siteTarget" ),
        siteOrder  = jQuery( "#siteOrder"  ),
        //
        allFields  = jQuery( [] ).add( siteName ).add( siteUrl ),
        tips       = jQuery( ".validateTips" );

    jQuery( "#dialog-form" ).dialog({
        dialogClass   : 'wp-dialog',
        modal         : true,
        closeOnEscape : true,
        title: "Add Site Menu",
        autoOpen: false,
        height: 480,
        width: 400,
        buttons: {
            "Add Site": function() {
                var bValid = true;
                allFields.removeClass( "ui-state-error" );
                bValid = bValid && checkLength( siteName, "Site Name", 3, 30 );
                bValid = bValid && checkLength( siteUrl, "Site URL", 3, 80 );
                if ( bValid ) {
                    jQuery("body").addClass("loading");
                    var data = {
                        action: 'submit_site',
                        task: 'new',
                        wpgm_siteName:   siteName.val()  ,
                        wpgm_siteUrl:    siteUrl.val()   ,
                        wpgm_siteAlt:    siteAlt.val()   ,
                        wpgm_siteTarget: siteTarget.val(),
                        wpgm_siteOrder:  siteOrder.val()
                    };
                    jQuery( "#dialog-form" ).removeClass("hidden");
                    jQuery.post(ajaxurl, data)
                        .done(function(data){ window.location = '?page=wpgroupmenu&tab=manage';})
                        .then(function(data){
                            jQuery( this ).dialog( "close" );
                            jQuery("body").removeClass("loading");
                        });

                }
            },
            Cancel: function() {
                jQuery( this ).dialog( "close" );
            }
        },
        close: function() {
            allFields.val( "" ).removeClass( "ui-state-error" );
        }
    }).dialog( "open" );
}

function wpgroupmenu_editSite(id){
   var siteName   = jQuery( "#siteName"   ),
       siteUrl    = jQuery( "#siteUrl"    ),
       siteAlt    = jQuery( "#siteAlt"    ),
       siteTarget = jQuery( "#siteTarget" ),
       siteOrder  = jQuery( "#siteOrder"  ),
       allFields  = jQuery( [] ).add(siteName).add(siteUrl).add(siteAlt).add(siteTarget).add(siteOrder),
       tips       = jQuery( ".validateTips" ),
       editBox    = jQuery( "#dialog-form" );

    editBox.dialog({
        dialogClass   : 'wp-dialog',
        modal         : true,
        closeOnEscape : true,
        title: "Edit Site Menu",
        title: "Edit Site Menu",
        title: "Edit Site Menu",
        autoOpen: false,
        height: 480,
        width: 400,
        buttons: {
            "Edit Site": function() {
                var bValid = true;
                allFields.removeClass( "ui-state-error" );
                bValid = bValid && checkLength( siteName, "Site Name", 3, 30 );
                bValid = bValid && checkLength( siteUrl, "Site URL", 3, 80 );
                if ( bValid ) {
                    var data = {
                        action: 'submit_site',
                        task: 'edit',
                        sid: id,
                        wpgm_siteName:   siteName.val()  ,
                        wpgm_siteUrl:    siteUrl.val()   ,
                        wpgm_siteAlt:    siteAlt.val()   ,
                        wpgm_siteTarget: siteTarget.val(),
                        wpgm_siteOrder:  siteOrder.val()
                    };
                    jQuery("body").addClass("loading");
                    jQuery.post(ajaxurl, data)
                        .done(function(data){
                            console.log(data);
                            window.location = '?page=wpgroupmenu&tab=manage';
                        }).then(function(data){
                            jQuery( this ).dialog( "close" );
                            jQuery("body").removeClass("loading");
                        });

                }
            },
            Cancel: function() {
                jQuery( this ).dialog( "close" );
            }
        },
        close: function() {
            allFields.val( "" ).removeClass( "ui-state-error" );
        }

    });

    var data = {
        action: 'submit_site',
        task: 'load',
        sid: id
    };
    jQuery.post(ajaxurl, data).done(function(response){
            var site = jQuery.parseJSON(response);
            console.log(site);
            siteName.val(site.siteName);
            siteUrl.val(site.siteUrl);
            siteAlt.val(site.siteAlt);
            siteTarget.val(site.siteTarget);
            siteOrder.val(site.siteOrder);
            editBox.dialog( "open" );
        });
}

function wpgroupmenu_delete(id) {
    if(confirm('Are you sure you want to delete this site?')) {
        location.href = "?page=wpgroupmenu&tab=manage&task=delete&id="+id+"";
    }
}

function loadWait(){
    jQuery("body").addClass("loading");
}


function wpgroupmenu_loadCssPreview(plugin_url, style){
    var url = plugin_url + style.value + '.png';
    jQuery("#wpgm_css_image").html("<img src=" +url + ">");
}
(function(){
    var window = this,
        $      = window.jQuery,
        btnADD = $("#wpgm_addSite");
    if ($ === undefined) alert("jquery n'existe pas!");
    // TODO :
    // initialisation
    function wpgroupmenu_init() {
        $("body").removeClass("dialog-open");
        btnADD.off().on("click", wpgroupmenu_load_form);
    }
    // function de chargement AJAX du formulaire
    function wpgroupmenu_load_form() {
        var source = this;
        $.ajax({
            url: '?page=wpgroupmenu&tab=manage',
            data: {
                ajax: "dialog-new"
            },
            dataType: "html",
            complete: function (callback) {
                $("#wpbody-content").append(callback.responseText);
            }
        });
        $(".module-settings-container").show().addClass("open");
        $("body").addClass("dialog-open");
    }
    // function d'envoi AJAX du formulaire
    function wpgroupmenu_send_form() {
        alert("send");
    }//wpgroupmenu_init();
})();
