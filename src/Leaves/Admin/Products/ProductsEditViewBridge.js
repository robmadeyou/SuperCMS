var bridge = function (leafPath) {
	window.rhubarb.viewBridgeClasses.ViewBridge.apply(this, arguments);
};

bridge.prototype = new window.rhubarb.viewBridgeClasses.ViewBridge();
bridge.prototype.constructor = bridge;

bridge.prototype.attachEvents = function () {
	var firstTab = $('.nav-bar-tabs-first');
	var self = this;

	$('#tab-add-button').click(function(){
		var lastSelected = $('.product-list-tabs.active a').data('id');

		self.raiseServerEvent('AddNewProduct', lastSelected);
	});

	$('#' + this.leafPath + '_VariationName').keyup(function(){
		firstTab.find('a').html($(this).val() + '<span class="delete-variation"><i class="fa fa-times fa-1x" aria-hidden="true"></i></span>');
	});
};

bridge.prototype.onBeforeUpdateDomUpdateFromServer = function() {
	tinymce.remove('#' + this.leafPath + '_Description');
	tinymce.remove('#' + this.leafPath + '_VariationDescription');
};

window.rhubarb.viewBridgeClasses.ProductsEditViewBridge = bridge;
