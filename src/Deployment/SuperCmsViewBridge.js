var scms = rhubarb.vb.create('SuperCmsViewBridge', function() {
    return {
        raiseProgressiveServerEvent:function(eventName) {
            var self = this;

            this.addLoaderClass();

            var argumentsArray = [];
            var copy = [].slice.call(arguments);
            var successCallback = false;
            var failureCallback = false;

            function success() {
                if (successCallback) {
                    successCallback.apply(this, arguments);
                }

                self.removeLoaderClass();
            }

            function failure() {
                if (failureCallback) {
                    failureCallback.apply(this, arguments);
                }
                self.removeLoaderClass();
            }

            // Get the arguments into a proper array while stripping any closure found to become a callback.

            for (var i = 0; i < arguments.length; i++) {
                if (arguments[i] instanceof Function) {
                    if (!successCallback) {
                        successCallback = arguments[i];
                        copy[i] = success;
                    } else if (!failureCallback) {
                        failureCallback = arguments[i];
                        copy[i] = failure;
                    }
                } else {
                    argumentsArray[i] = arguments[i];
                }
            }

            if (!successCallback) {
                copy.push(success);
            }

            if (!failureCallback) {
                copy.push(failure);
            }

            this.raiseServerEvent.apply(this, copy);
        },
        addLoaderClass:function(target) {
            target = target || $(this.viewNode);

            target.addClass('ajax-progress');
        },
        removeLoaderClass:function(target) {
            target = target || $(this.viewNode);

            target.removeClass('ajax-progress');
        }
    };
});

scms.create = function(name, ini, parent) {
    parent = parent || scms;

    rhubarb.vb.create(name, ini, parent);
};
