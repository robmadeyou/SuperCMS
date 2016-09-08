var dropDown = function (leafPath) {
	window.rhubarb.viewBridgeClasses.ViewBridge.apply(this, arguments);
};

dropDown.prototype = new window.rhubarb.viewBridgeClasses.ViewBridge();
dropDown.prototype.constructor = dropDown;

dropDown.prototype.attachEvents = function () {
	var Dropzone = new window.Dropzone("div#" + this.leafPath + ' div', {url:this.model.postUrl});

	resizeChosen();
	jQuery(window).on('resize', resizeChosen);

	function resizeChosen() {
		$(".chosen-container").each(function() {
			$(this).attr('style', 'width: 100%');
		});
	}
};

window.rhubarb.viewBridgeClasses.DropzoneViewBridge = dropDown;
