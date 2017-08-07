var bridge = function (leafPath) {
    window.rhubarb.viewBridgeClasses.ViewBridge.apply(this, arguments);
};

bridge.prototype = new window.rhubarb.viewBridgeClasses.ViewBridge();
bridge.prototype.constructor = bridge;

bridge.prototype.attachEvents = function () {
    var self = this;
    this.AddressLine1 = this.findChildViewBridge('AddressLine1');
    this.AddressLine2 = this.findChildViewBridge('AddressLine2');
    this.Town = this.findChildViewBridge('Town');
    this.PostCode = this.findChildViewBridge('PostCode');
    this.Country = this.findChildViewBridge('Country');
    this.PhoneNumber = this.findChildViewBridge('PhoneNumber');
    this.cancel = this.findChildViewBridge('Cancel');
    this.save = this.findChildViewBridge('Save');
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

    $('.js-select-location-item').click(function(event) {
        event.preventDefault();
        var current = $(this).closest('.js-location-item');
        self.raiseServerEvent('selectLocation', current.data('id'), function() {
            $('.js-location-item').removeClass('selected');
            current.addClass('selected');
        });
    });

    this.cancel.viewNode.onclick = this.closeModal;

    this.save.attachClientEventHandler('OnButtonPressed', function(event) {
        if (self.validate()) {
            self.viewNode.classList.add('ajax-progress');
            self.closeModal();
        } else {
            return false;
        }
    });

    this.save.attachClientEventHandler('ButtonPressCompleted', function(){
        self.viewNode.classList.remove('ajax-progress');
    });
};

bridge.prototype.loadEditData = function() {
    var self = this;

    var modal = this.modal.find('.modal-content');
    modal.addClass('ajax-progress');
    this.raiseServerEvent('loadData', function(data) {
        if (data) {
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

bridge.prototype.validate = function() {
    var fieldsToValidate = [
        'AddressLine1',
        'Town',
        'PostCode',
        'Country'
    ];

    var success = true;

    for (var i = 0; i < fieldsToValidate.length; i++) {
        var input = eval('this.' + fieldsToValidate[i]);
        if (!input.getValue()) {
            $(input.viewNode).closest('.form-group').addClass('has-error');
            $(input.viewNode).closest('.form-group').find('.required').append(' <span>This field is required</span>');
            success = false;
        }
    }
    return success;
};

bridge.prototype.closeModal = function() {
    $('.modal-location-edit').modal('hide');
};

window.rhubarb.viewBridgeClasses.LocationPickerViewBridge = bridge;
