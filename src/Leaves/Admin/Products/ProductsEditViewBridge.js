var dropDown = function (leafPath) {
	window.rhubarb.viewBridgeClasses.ViewBridge.apply(this, arguments);
};

bridge.prototype = new window.rhubarb.viewBridgeClasses.ViewBridge();
bridge.prototype.constructor = bridge;

bridge.prototype.attachEvents = function () {

	var firstTab = $('.nav-bar-tabs-first');
	var self = this;

	var priceInput = $('#' + this.leafPath + '_Price');
	var amountAvaiable = $('#' + this.leafPath + '_AmountAvailable');
	var description = $('#' + this.leafPath + '_Description');
	var properties = $('#' + this.leafPath );

	$('.product-variation-tab').click(function(event) {

		changeTab($(this).parent());

		self.raiseServerEvent('ChangeProductVariation', $(this).data('id'));

		event.preventDefault();
		return false;
	});

	$('#tab-add-button').click(function(){
		self.raiseServerEvent('AddNewProduct');
	});

	function changeTab(tab) {
		$('.active').removeClass('active');

		tab.addClass('active');
	}

	$('#' + this.leafPath + '_Name').keyup(function(){
		firstTab.find('a').html($(this).val());
	});
};

bridge.prototype.onBeforeUpdateDomUpdateFromServer = function() {
	tinymce.remove('#' + this.leafPath + '_Description');
	tinymce.remove('#' + this.leafPath + '_VariationDescription');
};

window.rhubarb.viewBridgeClasses.ProductsEditViewBridge = bridge;
