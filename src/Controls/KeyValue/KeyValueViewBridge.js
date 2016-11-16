var bridge = function (leafPath) {
    window.rhubarb.viewBridgeClasses.ViewBridge.apply(this, arguments);
};

bridge.prototype = new window.rhubarb.viewBridgeClasses.ViewBridge();
bridge.prototype.constructor = bridge;

bridge.prototype.attachEvents = function () {
    var self = this;
    $("#" + this.leafPath + ' #addTrigger').click(function (event) {

        var text = $("#" + self.leafPath + ' #hidden-line-placeholders').html();
        $(this).prev().append(text);
        event.preventDefault();
        return false;
    });

    $("#" + this.leafPath + " .key-value-group").on("click", "#removeTrigger", function () {
        if (confirm("Are you sure you want to remove this?")) {
            $(this).parent().remove();
        }
    });
};

window.rhubarb.viewBridgeClasses.KeyValueViewBridge = bridge;
