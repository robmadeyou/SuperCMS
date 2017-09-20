var bridge = function (leafPath) {
	window.rhubarb.viewBridgeClasses.ViewBridge.apply(this, arguments);
};

bridge.prototype = new window.rhubarb.viewBridgeClasses.ViewBridge();
bridge.prototype.constructor = bridge;

bridge.prototype.attachEvents = function () {
	var self = this;

    if (this.model.openLocationByDefault) {
		$(this.viewNode).find('.js-add-location').click();
	}
};

window.rhubarb.viewBridgeClasses.CheckoutAddressViewBridge = bridge;