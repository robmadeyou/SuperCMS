var dropDown = function (leafPath) {
	window.rhubarb.viewBridgeClasses.DropDownViewBridge.apply(this, arguments);
};

dropDown.prototype = new window.rhubarb.viewBridgeClasses.DropDownViewBridge();
dropDown.prototype.constructor = dropDown;

dropDown.prototype.attachEvents = function () {
    $('#' + this.leafPath).chosen();

    resizeChosen();
    jQuery(window).on('resize', resizeChosen);

    function resizeChosen() {
        $(".chosen-container").each(function() {
            $(this).attr('style', 'width: 100%');
        });
    }
};

selectionControl.prototype.getValue = function () {
	// If the control only supports a single selection then just return
	// the first of the selected items (or false if none selected)
	if (!this.supportsMultipleSelection) {
		if (this.model.selectedItems.length > 0 && this.model.selectedItems[0] != undefined) {
			return this.model.selectedItems[0].value;
		}
		else {
			return false;
		}
	}
	else {
		var values = [];

		var checkedBoxes = this.viewNode.querySelectorAll('input:checked');
		for (var i = 0; i < checkedBoxes.length; i++) {
			values.push(checkedBoxes[i].value);
		}

		return values;
	}
};

window.rhubarb.viewBridgeClasses.ChosenDropdownViewBridge = dropDown;
