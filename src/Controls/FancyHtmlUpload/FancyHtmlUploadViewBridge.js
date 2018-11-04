scms.create('FancyHtmlUploadViewBridge', function() {
    return {
        attachEvents:function() {
            $('.upload input[type=file]').each(function () {
                var eventNamespace = '.upload';
                var labelInputValueAttr = 'data-input-value';
                var $input = $(this);
                var $inputClone = $input.clone(true,true);
                $inputClone.removeClass('empty');
                var $label = $input.next('label');
                var setLabelInputValue = function () {
                    var $input = $(this);
                    if($input.val() && $input.val() !== ''){
                        $input.removeClass('empty');
                        $label.attr(labelInputValueAttr, $input.val().split('\\').pop());
                    } else {
                        $label.attr(labelInputValueAttr, '');
                        $input.addClass('empty');
                    }
                };
                if(!$input.val() || $input.val() === ''){
                    $input.addClass('empty');
                }
                $label.attr(labelInputValueAttr,'');
                $input.on('change' + eventNamespace, setLabelInputValue);
                $label.on('click' + eventNamespace, function (event) {
                    if($input.val() && $input.val() !== '' && $input.is(':valid')){
                        event.preventDefault();
                        $input.remove();
                        $label.before($inputClone); // cant just empty val because of ie
                        $input = $inputClone;
                        if(!$input.val() || $input.val() === ''){
                            $input.addClass('empty');
                        }
                        $inputClone = $input.clone(true,true);
                        $inputClone.removeClass('empty');
                        $input.off('change' + eventNamespace);
                        $input.on('change' + eventNamespace, setLabelInputValue);
                        $label.attr(labelInputValueAttr,'');
                    }
                });
            });
        }
    };
}, window.rhubarb.viewBridgeClasses.SimpleFileUploadViewBridge);