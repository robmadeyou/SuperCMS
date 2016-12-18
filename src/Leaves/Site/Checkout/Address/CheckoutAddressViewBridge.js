var bridge = function (leafPath) {
	window.rhubarb.viewBridgeClasses.ViewBridge.apply(this, arguments);
};

bridge.prototype = new window.rhubarb.viewBridgeClasses.ViewBridge();
bridge.prototype.constructor = bridge;

bridge.prototype.attachEvents = function () {

	var self = this;
	var handler = StripeCheckout.configure({
		key:this.model.stripePubKey,
		locale:'auto',
		image: '/static/favicon/favicon-128.png',
		token: function(token) {
			self.raiseServerEvent('paymentMade', token, function() {

			});
		}
	});

	document.getElementById('stripe-payment').addEventListener('click', function(e) {
		// Open Checkout with further options:
		handler.open({
			name: '',
			description: '',
			currency:'gbp',
			amount: self.model.basketAmount,
			email: self.model.email
		});
		e.preventDefault();
	});
};

window.rhubarb.viewBridgeClasses.CheckoutAddressViewBridge = bridge;