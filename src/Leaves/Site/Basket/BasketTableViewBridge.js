var bridge = function (leafPath) {
    window.rhubarb.viewBridgeClasses.TableViewBridge.apply(this, arguments);
};

bridge.prototype = new window.rhubarb.viewBridgeClasses.TableViewBridge();
bridge.prototype.constructor = bridge;

bridge.prototype.attachEvents = function () {
   window.rhubarb.viewBridgeClasses.TableViewBridge.prototype.attachEvents();
};

window.rhubarb.viewBridgeClasses.BasketTableViewBridge = bridge;