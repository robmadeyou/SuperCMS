var bridge = function (leafPath) {
	window.rhubarb.viewBridgeClasses.ViewBridge.apply(this, arguments);
};

bridge.prototype = new window.rhubarb.viewBridgeClasses.ViewBridge();
bridge.prototype.constructor = bridge;

bridge.prototype.attachEvents = function () {
	var self = this;
	this.Recipient = this.findChildViewBridge('Recipient');
	this.AddressLine1 = this.findChildViewBridge('AddressLine1');
	this.AddressLine2 = this.findChildViewBridge('AddressLine2');
	this.Town = this.findChildViewBridge('Town');
	this.PostCode = this.findChildViewBridge('PostCode');
	this.Country = this.findChildViewBridge('Country');
	this.PhoneNumber = this.findChildViewBridge('PhoneNumber');
	this.cancel = this.findChildViewBridge('Cancel');
	this.modal = $('.modal-location-edit');

	$('.js-location-edit').click(function(){
		var current = $(this);

		self.model.selectedLocation = current.data('id');
		self.saveState();

		self.loadEditData();
	});

	$('.js-location-delete').click(function(event){
		var current = $(this);

		self.model.selectedLocation = current.data('id');
		self.saveState();

		self.viewNode.classList.add('ajax-progress');
		self.raiseServerEvent('delete', function() {
			self.viewNode.classList.remove('ajax-progress');
		});

		event.preventDefault();
		return false;
	});

	$('.js-add-location').click(function() {
		self.model.selectedLocation = 0;
		self.saveState();

		self.loadEditData();
	});

	$('.js-location-item').click(function() {
		var current = $(this);
		self.raiseServerEvent('selectLocation', current.data('id'), function() {
			$('.js-location-item').removeClass('selected');
			current.addClass('selected');
		});
	});

	this.cancel.viewNode.onclick = function() {
		self.modal.find('.close').click();
	}
};

bridge.prototype.loadEditData = function() {
	var self = this;

	var modal = this.modal.find('.modal-content');
	modal.addClass('ajax-progress');
	this.raiseServerEvent('loadData', function(data) {
		if (data) {
			self.Recipient.setValue(data.Recipient);
			self.AddressLine1.setValue(data.AddressLine1);
			self.AddressLine2.setValue(data.AddressLine2);
			self.Town.setValue(data.Town);
			self.PostCode.setValue(data.PostCode);
			self.Country.setValue(data.Country);
			self.PhoneNumber.setValue(data.PhoneNumber);
		}
		modal.removeClass('ajax-progress');
	});
};

window.rhubarb.viewBridgeClasses.LocationPickerViewBridge = bridge;
