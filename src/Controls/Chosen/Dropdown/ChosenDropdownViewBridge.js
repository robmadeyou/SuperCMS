var dropDown = function (leafPath) {
	window.rhubarb.viewBridgeClasses.DropDownViewBridge.apply(this, arguments);
};

dropDown.prototype = new window.rhubarb.viewBridgeClasses.DropDownViewBridge();
dropDown.prototype.constructor = dropDown;

dropDown.prototype.attachEvents = function () {
	$('#' + this.leafPath).chosen();
};

window.rhubarb.viewBridgeClasses.ChosenDropdownViewBridge = dropDown;
