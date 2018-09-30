var bridge = function (leafPath) {
    window.rhubarb.viewBridgeClasses.TextBoxViewBridge.apply(this, arguments);
};

bridge.prototype = new window.rhubarb.viewBridgeClasses.TextBoxViewBridge();
bridge.prototype.constructor = bridge;

bridge.prototype.attachEvents = function () {

    var self = this;

    tinymce.init(
        {
            selector: '#' + this.leafPath,
            plugins:[
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste imagetools wordcount"
            ],
            browser_spellcheck: true,
            contextmenu: false,
            images_upload_url: 'postAcceptor.php',
            images_upload_base_path: '/some/basepath',
            images_upload_credentials: true
        });
};

window.rhubarb.viewBridgeClasses.HtmlEditorViewBridge = bridge;
