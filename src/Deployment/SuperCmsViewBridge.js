var scms = rhubarb.vb.create('SuperCmsViewBridge', function() {
    return {
        raiseProgressiveServerEvent:function(eventName) {
            var self = this;

            this.addLoaderClass();

            var argumentsArray = [];
            var successCallback = false;
            var failureCallback = false;

            // Get the arguments into a proper array while stripping any closure found to become a callback.

            for (var i = 0; i < arguments.length; i++) {
                if (arguments[i] instanceof Function) {
                    if (!successCallback) {
                        successCallback = arguments[i];
                    } else if (!failureCallback) {
                        failureCallback = arguments[i];
                    }
                } else {
                    argumentsArray[i] = arguments[i];
                }
            }

            function success() {
                if (successCallback) {
                    successCallback(arguments);
                }
                self.removeLoaderClass();
            }

            function failure() {
                if (failureCallback) {
                    failureCallback(arguments);
                }
                self.removeLoaderClass();
            }

            this.raiseServerEvent(eventName, argumentsArray, success, failure);
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

