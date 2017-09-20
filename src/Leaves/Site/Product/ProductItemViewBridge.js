var bridge = function (leafPath) {
	window.rhubarb.viewBridgeClasses.ViewBridge.apply(this, arguments);
};

bridge.prototype = new window.rhubarb.viewBridgeClasses.ViewBridge();
bridge.prototype.constructor = bridge;

bridge.prototype.attachEvents = function () {
	var self = this;
	var variationDropdown = this.findChildViewBridge('Variations');

	$(variationDropdown.viewNode).change(function (event){
		self.changeVariation(variationDropdown.getValue());
		event.preventDefault();
		return false;
	});

	var addToBasket = this.findChildViewBridge('AddToBasket');

	$(addToBasket.viewNode).click(function(event) {
		var parent = $(this).closest('div');
		parent.addClass('ajax-progress');
		self.raiseServerEvent('addToCart', function(){
			parent.removeClass('ajax-progress');
		});
		event.preventDefault();
	});
};

bridge.prototype.changeVariation = function(id) {
	this.model.selectedVariationId = id;
	this.saveState();

	this.raiseServerEvent('changeSelectedVariation', id, function(values) {
		var image = $('.c-main-product-image');
		var imageLink = image.closest('a');
		var name = $('.c-product-variation-title');
		var desc = $('.c-product-variation-desc');

		image.attr('src', values.MainImage);
		imageLink.attr('href', values.LargeImage);
		name.html(values.Name);
		desc.html(desc);
	});
};

window.rhubarb.viewBridgeClasses.ProductItemViewBridge = bridge;
