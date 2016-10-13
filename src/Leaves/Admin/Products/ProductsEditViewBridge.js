var bridge = function (leafPath) {
	window.rhubarb.viewBridgeClasses.ViewBridge.apply(this, arguments);
};

bridge.prototype = new window.rhubarb.viewBridgeClasses.ViewBridge();
bridge.prototype.constructor = bridge;

bridge.prototype.attachEvents = function () {

	var firstTab = $('.nav-bar-tabs-first');
	var self = this;

	$('.product-variation-tab').click(function(event) {
		var lastSelected = $('.product-list-tabs.active a').data('id');
		changeTab($(this).parent());

		self.raiseServerEvent('ChangeProductVariation', lastSelected, $(this).data('id'));
		event.preventDefault();
		return false;
	});

	$('#tab-add-button').click(function(){
		var lastSelected = $('.product-list-tabs.active a').data('id');

		self.raiseServerEvent('AddNewProduct', lastSelected);
	});

	$('#' + this.leafPath + ' .delete-variation').click(function(event){
		if (confirm('Are you sure you want to remove this variation?')) {
			self.raiseServerEvent('VariationDelete', $(this).parent().data('id'));
		}
		event.preventDefault();
		event.stopPropagation();
		return false;
	});

	function changeTab(tab) {
		$('#' + this.leaftPath + ' .active').removeClass('active');

		tab.addClass('active');
	}

	$('#' + this.leafPath + '_VariationName').keyup(function(){
		firstTab.find('a').html($(this).val());
	});
};

bridge.prototype.onBeforeUpdateDomUpdateFromServer = function() {
	tinymce.remove('#' + this.leafPath + '_Description');
	tinymce.remove('#' + this.leafPath + '_VariationDescription');
};

window.rhubarb.viewBridgeClasses.ProductsEditViewBridge = bridge;
