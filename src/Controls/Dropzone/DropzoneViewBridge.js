var bridge = function (leafPath) {
	window.rhubarb.viewBridgeClasses.ViewBridge.apply(this, arguments);
};

bridge.prototype = new window.rhubarb.viewBridgeClasses.ViewBridge();
bridge.prototype.constructor = bridge;

bridge.prototype.attachEvents = function () {
	var self = this;
	var path = $('.dropzone-post-url').val();
	var dz = new window.Dropzone("div#" + this.leafPath + ' div', {
		url:path,
		parallelUploads: 100,
		init: function() {
			this.on('queuecomplete', function(file) {
				var files = this.files;
				for(var i = 0; i < files.length; i++) {
					files[i].imageSrc = $(this.files[i].previewElement).find('img').attr('src');
				}
				self.raiseServerEvent('FilesUploaded', path);
			})
		}
	});

	$('.dz-close-button').click(function() {
		var image = $(this).parent().find('.dz-image img').attr('src');
		var element = $(this);
		self.raiseServerEvent('deleteImage', image, function() {
			element.parent().remove();
		});
	});
};

bridge.prototype.findEventHost = function () {
	var selfNode = document.getElementById(this.leafPath);

	while (selfNode) {
		var testNode = selfNode;

		selfNode = selfNode.parentNode;

		var className = ( testNode.className ) ? testNode.className : "";

		if (className.indexOf("event-host") == 0 || className.indexOf("event-host") > 0) {
			if (!testNode.viewBridge) {
				if (!testNode.id) {
					testNode.id = "event-host";
				}

				new window.ViewBridge(testNode.id);

				if ((testNode.className.indexOf("event-host") == 0 || testNode.className.indexOf("event-host") > 0) && testNode.viewBridge != undefined) {
					testNode.viewBridge.host = true;
				}
			}
		}

		if (testNode.viewBridge && testNode.viewBridge.host && testNode.className.indexOf("configured") == -1) {
			return testNode.viewBridge;
		}
	}

	return false;
};

window.rhubarb.viewBridgeClasses.DropzoneViewBridge = bridge;
