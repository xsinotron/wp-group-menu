(function(){
    var window = this,
        $      = window.jQuery,
        btnCLOSE  = $(".close-dialog"),
        btnLEFT   = $("button.left"),
        btnRIGHT  = $("button.right"),
        btnVALID  = $(".module-settings-valid"),
        btnCANCEL = $(".module-settings-cancel");
    if ($ === undefined) alert("jquery n'existe pas!");
    // function de chargement AJAX du formulaire
    function dialog_load_form() {
        var source = this;
        $.ajax({
            url: window.plugin_url+"/views/dialog.php",
            data: $(source).data(),
            dataType: "html",
            complete: function (callback) {
                $("#wpbody-content").append(callback.responseText);
            }
        });
    }
    function dialog_close () {
        $(".module-settings-container").remove();
    }
    function dialog_prev  () {

    }
    function dialog_next  () {

    }
    function dialog_valid () {
        alert("send");
    }
    function dialog_cancel() {

    }
    // initialisation
    function dialog_init() {
        btnCLOSE .off().on("click", dialog_close);
        btnLEFT  .off().on("click", dialog_prev);
        btnRIGHT .off().on("click", dialog_next);
        btnVALID .off().on("click", dialog_valid);
        btnCANCEL.off().on("click", dialog_cancel);
    }
    dialog_init();
})();
