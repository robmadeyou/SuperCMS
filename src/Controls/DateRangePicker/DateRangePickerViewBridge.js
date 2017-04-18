var date = function (leafPath) {
	window.rhubarb.viewBridgeClasses.ViewBridge.apply(this, arguments);
};

date.prototype = new window.rhubarb.viewBridgeClasses.ViewBridge();
date.prototype.constructor = date;

date.prototype.attachEvents = function () {
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

window.rhubarb.viewBridgeClasses.DateRangePickerViewBridge = date;
