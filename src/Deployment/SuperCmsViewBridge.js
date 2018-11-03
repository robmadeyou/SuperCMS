var scms = rhubarb.vb.create('SuperCmsViewBridge', function () {
    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('js-clickthrough-link')) {
            var action = event.target.getAttribute('forButton');

            if (action) {
                var triggerButton = document.getElementById(action);

                if (triggerButton) {
                    triggerButton.click();
                }
            }

            event.stopPropagation();
            event.preventDefault();

            return false;
        }
    });

    return {
        raiseProgressiveServerEvent: function (eventName) {
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
        findEventHost: function () {
            var selfNode = document.getElementById(this.leafPath);

            while (selfNode) {
                var testNode = selfNode;

                selfNode = selfNode.parentNode;

                var className = (testNode.className) ? testNode.className : "";

                if (className.indexOf("event-host") == 0 || className.indexOf("event-host") > 0) {
                    if (!testNode.viewBridge) {
                        if (!testNode.id) {
                            testNode.id = "event-host";
                        }

                        new window.ViewBridge(testNode.id);

                        if ((testNode.className.indexOf("event-host") == 0 || testNode.className.indexOf("event-host") > 0) && testNode.viewBridge != undefined) {
                            testNode.viewBridge.host = true;
                        }
                    }
                }

                if (testNode.viewBridge && testNode.viewBridge.host && testNode.className.indexOf("configured") == -1) {
                    return testNode.viewBridge;
                }
            }

            return false;
        },
        addLoaderClass: function (target) {
            target = target || $(this.viewNode);

            target.addClass('ajax-progress');
        },
        removeLoaderClass: function (target) {
            target = target || $(this.viewNode);

            target.removeClass('ajax-progress');
        }
    };
});

scms.create = function (name, ini, parent) {
    parent = parent || scms;

    rhubarb.vb.create(name, ini, parent);
};
