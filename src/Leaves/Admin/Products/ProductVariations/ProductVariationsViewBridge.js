scms.create('ProductVariationsViewBridge', function(){
    return {
        attachEvents:function () {
            var self = this;

            $(this.viewNode, '.product-variation-tab').click(function(event) {
                if (!event.target.classList.contains('fa')) {
                    self.changeTab($(this).parent());
                } else {
                    if (confirm('Are you sure you want to remove this variation?')) {
                        self.raiseServerEvent('VariationDelete', $(this).data('id'));
                    }
                }

            });
        },

        changeTab:function(tab){
            var lastSelected = $('.product-list-tabs.active a');

            this.raiseProgressiveServerEvent('changeVariation', lastSelected.data('id'), tab.data('id'));

            lastSelected.removeClass('active');
            tab.addClass('active');
        }
    };
});