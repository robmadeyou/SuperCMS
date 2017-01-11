var bridge = function (leafPath) {
    window.rhubarb.viewBridgeClasses.ViewBridge.apply(this, arguments);
};

bridge.prototype = new window.rhubarb.viewBridgeClasses.ViewBridge();
bridge.prototype.constructor = bridge;

bridge.prototype.attachEvents = function () {
    var tree = this.findChildViewBridge('CategoryTree');
    var saveButton = this.findChildViewBridge('Save');
    var self = this;

    saveButton.viewNode.onclick = function(event) {
        var status = tree.getValue();
        self.raiseServerEvent('saveHierarchy', status);
        event.preventDefault();
    }
};

window.rhubarb.viewBridgeClasses.HierarchyViewBridge = bridge;
