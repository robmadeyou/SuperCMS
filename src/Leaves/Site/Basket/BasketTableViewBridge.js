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

    $('.js-quantitypicker').change(function(){
        var update = $('<a href="" class="c-quantity-update">Update</a>');
        var amount = $(this).val();
        var id = $(this).data('id');
        update.click(function(event){
            event.preventDefault();
            self.raiseServerEvent('updateQuantity', id, amount, function() {
                update.remove();
            });
        });
        $(this).after(update);
    })
};

window.rhubarb.viewBridgeClasses.BasketTableViewBridge = bridge;