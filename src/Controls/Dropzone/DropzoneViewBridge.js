var dropDown = function (leafPath) {
	window.rhubarb.viewBridgeClasses.SimpleFileUploadViewBridge.apply(this, arguments);
};

dropDown.prototype = new window.rhubarb.viewBridgeClasses.SimpleFileUploadViewBridge();
dropDown.prototype.constructor = dropDown;

dropDown.prototype.attachEvents = function () {
	var self = this;

	var Dropzone = new Dropzone("div#" + this.leafPath);
};

window.rhubarb.viewBridgeClasses.DropzoneViewBridge = dropDown;
