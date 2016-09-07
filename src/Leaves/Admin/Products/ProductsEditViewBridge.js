var dropDown = function (leafPath) {
	window.rhubarb.viewBridgeClasses.ViewBridge.apply(this, arguments);
};

bridge.prototype = new window.rhubarb.viewBridgeClasses.ViewBridge();
bridge.prototype.constructor = bridge;

bridge.prototype.attachEvents = function () {
	$('.product-variation-tab').click(function(event) {

		changeTab($(this).parent());

		event.preventDefault();
		return false;
	});

	function changeTab(tab) {
		$('.active').removeClass('active');

		tab.addClass('active');
	}
};

window.rhubarb.viewBridgeClasses.ProductsEditViewBridge = bridge;
