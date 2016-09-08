var dropDown = function (leafPath) {
	window.rhubarb.viewBridgeClasses.ViewBridge.apply(this, arguments);
};

bridge.prototype = new window.rhubarb.viewBridgeClasses.ViewBridge();
bridge.prototype.constructor = bridge;

bridge.prototype.attachEvents = function () {

	var firstTab = $('.nav-bar-tabs-first');

	$('.product-variation-tab').click(function(event) {

		changeTab($(this).parent());

		event.preventDefault();
		return false;
	});

	function changeTab(tab) {
		$('.active').removeClass('active');

		tab.addClass('active');
	}

	$('#' + this.leafPath + '_Name').keyup(function(){
		firstTab.find('a').html($(this).val());
	});
};

window.rhubarb.viewBridgeClasses.ProductsEditViewBridge = bridge;
