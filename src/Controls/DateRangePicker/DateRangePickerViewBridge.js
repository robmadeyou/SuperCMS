var dropDown = function (leafPath) {
	window.rhubarb.viewBridgeClasses.ViewBridge.apply(this, arguments);
};

dropDown.prototype = new window.rhubarb.viewBridgeClasses.ViewBridge();
dropDown.prototype.constructor = dropDown;

dropDown.prototype.attachEvents = function () {
	var self = this;

	$('#' + this.leafPath + ' input').daterangepicker(
		{
			locale: {
				format:'DD/MM/YYYY'
			},
			'startDate': self.model.startDate,
			'endDate': self.model.endDate
		}
	);
};

window.rhubarb.viewBridgeClasses.DateRangePickerViewBridge = dropDown;
