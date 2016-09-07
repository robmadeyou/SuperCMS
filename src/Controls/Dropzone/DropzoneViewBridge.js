var dropDown = function (leafPath) {
	window.rhubarb.viewBridgeClasses.ViewBridge.apply(this, arguments);
};

dropDown.prototype = new window.rhubarb.viewBridgeClasses.ViewBridge();
dropDown.prototype.constructor = dropDown;

dropDown.prototype.attachEvents = function () {
	debugger;
	var self = this;

	var Dropzone = new window.Dropzone("div#" + this.leafPath, {url:this.model.postUrl});
};

window.rhubarb.viewBridgeClasses.DropzoneViewBridge = dropDown;
