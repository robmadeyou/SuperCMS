var bridge = function (leafPath) {
    window.rhubarb.viewBridgeClasses.TableViewBridge.apply(this, arguments);
};

bridge.prototype = new window.rhubarb.viewBridgeClasses.TableViewBridge();
bridge.prototype.constructor = bridge;

bridge.prototype.attachEvents = function () {

    var self = this;
    var totalCostElement = $('.c-basket-total');

    $('.js-remove-product').click(function(event){
        var object = this;
        if (confirm('Are you sure you want to remove this item?')) {
            var row = $(object.closest('.basket-product'));
            row.fadeOut();
            self.raiseServerEvent('removeItem', $(this).data('id'), function(totalCost){
                row.remove();
                totalCostElement.html(totalCost);
            });
        }
        event.preventDefault();
        return false;
    });


    var quantityPicker = $('.js-quantitypicker');
    quantityPicker.keyup(function(event){
        var obj = $(this);
        var updateTriggered = $(this).hasClass('changed');

        if (!updateTriggered) {
            obj.addClass('changed');
            var update = $('<a href="" class="c-quantity-update">Update</a>');
            update.click(function(event){
                var amount = obj.val();
                var id = obj.data('id');
                event.preventDefault();
                var costSide = $(this).closest('.product-price');
                costSide.addClass('ajax-progress');
                self.raiseServerEvent('updateQuantity', id, amount, function(amount) {

                    costSide.find('.product-cost').html(amount.Single);
                    totalCostElement.html(amount.Total);

                    update.remove();
                    costSide.removeClass('ajax-progress');
                    obj.removeClass('changed');
                }.bind(this));
            });
            $(this).after(update);
        }
    });

    quantityPicker.keydown(function(event) {
        if (event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    })
};

window.rhubarb.viewBridgeClasses.BasketTableViewBridge = bridge;