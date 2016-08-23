var bridge = function (leafPath) {
    window.rhubarb.viewBridgeClasses.TextBoxViewBridge.apply(this, arguments);
};

bridge.prototype = new window.rhubarb.viewBridgeClasses.TextBoxViewBridge();
bridge.prototype.constructor = bridge;

bridge.prototype.attachEvents = function () {
    tinymce.baseURL = '/static/js/tinymce';
    tinymce.init(
        {
            selector: '#' + this.leafPath,
            themes: "inlite"
        });
};

window.rhubarb.viewBridgeClasses.HtmlEditorViewBridge = bridge;
