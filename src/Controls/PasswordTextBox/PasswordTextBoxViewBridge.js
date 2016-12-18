var bridge = function (leafPath) {
	window.rhubarb.viewBridgeClasses.TextBoxViewBridge.apply(this, arguments);
};

bridge.prototype = new window.rhubarb.viewBridgeClasses.TextBoxViewBridge();
bridge.prototype.constructor = bridge;

bridge.prototype.attachEvents = function () {
	var thisJquery = $(this.viewNode);
	var pwd = thisJquery.find('input[type=password]');
	thisJquery.find(".reveal").mousedown(function() {
		pwd.attr('type', 'text');
	}).mouseup(function() {
			pwd.attr('type', 'password');
		})
		.mouseout(function() {
			pwd.attr('type', 'password');
		});
};

window.rhubarb.viewBridgeClasses.PasswordTextBoxViewBridge = bridge;
