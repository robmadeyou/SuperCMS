var bridge = function (leafPath) {
	window.rhubarb.viewBridgeClasses.ViewBridge.apply(this, arguments);
};

bridge.prototype = new window.rhubarb.viewBridgeClasses.ViewBridge();
bridge.prototype.constructor = bridge;

bridge.prototype.attachEvents = function () {
	var firstTab = $('.nav-bar-tabs-first');
	var self = this;

	$('.product-variation-tab').click(function(event) {
		$(this).closest('.form-body').addClass('ajax-progress');
		if (!event.target.classList.contains('fa')) {
			var lastSelected = $('.product-list-tabs.active a').data('id');
			changeTab($(this).parent());

			self.raiseServerEvent('ChangeProductVariation', lastSelected, $(this).data('id'));
			event.preventDefault();
			return false;
		} else {
			if (confirm('Are you sure you want to remove this variation?')) {
				self.raiseServerEvent('VariationDelete', $(this).data('id'));
			}
			event.preventDefault();
			event.stopPropagation();
			return false;
		}

	});

	$('#tab-add-button').click(function(){
		var lastSelected = $('.product-list-tabs.active a').data('id');

		self.raiseServerEvent('AddNewProduct', lastSelected);
	});

	function changeTab(tab) {
		$('#' + this.leaftPath + ' .active').removeClass('active');

		tab.addClass('active');
	}

	$('#' + this.leafPath + '_VariationName').keyup(function(){
		firstTab.find('a').html($(this).val() + '<span class="delete-variation"><i class="fa fa-times fa-1x" aria-hidden="true"></i></span>');
	});
};

bridge.prototype.onBeforeUpdateDomUpdateFromServer = function() {
	tinymce.remove('#' + this.leafPath + '_Description');
	tinymce.remove('#' + this.leafPath + '_VariationDescription');
};

window.rhubarb.viewBridgeClasses.ProductsEditViewBridge = bridge;
