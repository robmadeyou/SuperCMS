var table = function (leafPath) {
	window.rhubarb.viewBridgeClasses.TableViewBridge.apply(this, arguments);
};

table.prototype = new window.rhubarb.viewBridgeClasses.TableViewBridge();
table.prototype.constructor = table;

table.prototype.attachEvents = function () {
	window.rhubarb.viewBridgeClasses.TableViewBridge.prototype.attachEvents.apply(this);
	var self = this;

	$(this.viewNode).find('.search-product').click(function(event){
		if (event.target.tagName == 'A') {
			return;
		}

		var current = $(this);
		var to = current.find('.go');
		if (to.length) {
			window.location.href = to.attr('href');
		}
	});
};

window.rhubarb.viewBridgeClasses.ProductListTableViewBridge = table;