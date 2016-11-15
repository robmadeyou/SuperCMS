var bridge = function (leafPath) {
    window.rhubarb.viewBridgeClasses.TableViewBridge.apply(this, arguments);
};

bridge.prototype = new window.rhubarb.viewBridgeClasses.TableViewBridge();
bridge.prototype.constructor = bridge;

bridge.prototype.attachEvents = function () {

    var self = this;
    $('.js-remove-product').click(function(){
        var object = this;
        if (confirm('Are you sure you want to remove this item?')) {
            self.raiseServerEvent('removeItem', $(this).data('id'), function(){
                object.closest('.basket-product').remove();
            });
        }
    });

    var updateTriggered = false;
    $('.js-quantitypicker').keyup(function(){
        if (!updateTriggered) {
            updateTriggered = true;
            var obj = $(this);
            var update = $('<a href="" class="c-quantity-update">Update</a>');
            update.click(function(event){
                var amount = obj.val();
                var id = obj.data('id');
                event.preventDefault();
                var costSide = $(this).closest('.product-price');
                costSide.addClass('ajax-progress');
                self.raiseServerEvent('updateQuantity', id, amount, function(amount) {
                    costSide.find('.product-cost').html(amount);
                    update.remove();
                    costSide.removeClass('ajax-progress');
                    updateTriggered = false;
                }.bind(this));
            });
            $(this).after(update);
        }
    })
};

window.rhubarb.viewBridgeClasses.BasketTableViewBridge = bridge;