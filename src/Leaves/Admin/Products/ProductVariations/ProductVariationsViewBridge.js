scms.create('ProductVariationsViewBridge', function(){
    return {
        firstTab:null,
        attachEvents:function () {
            var self = this;

            this.firstTab = $('.nav-bar-tabs-first');

            $('#' + this.leafPath + '_Name').keyup(function(){
                self.firstTab.find('a').html($(this).val() + '<span class="delete-variation"><i class="fa fa-times fa-1x" aria-hidden="true"></i></span>');
            });

            $('.product-variation-tab', this.viewNode).click(function(event) {
                if (!event.target.classList.contains('fa')) {
                    self.changeTab($(this).parent());
                } else {
                    if (confirm('Are you sure you want to remove this variation?')) {
                        var tab = $(this);
                        self.raiseServerEvent('deleteVariation', tab.data('id'), function(response) {
                            if (response.success) {
                                self.deleteVariation(tab);
                            }
                        });
                    }
                }
            });

            $('#tab-add-button', this.viewNode).click(function(){
                var lastSelected = $('.product-list-tabs.active a').data('id');

                self.raiseServerEvent('AddNewProduct', lastSelected);
            });
        },

        changeTab:function(tab){
            var lastSelected = $('.product-list-tabs.active');

            this.raiseProgressiveServerEvent('changeVariation', lastSelected.data('id'), tab.data('id'));

            lastSelected.removeClass('active');
            tab.addClass('active');
        },

        deleteVariation:function(tab) {
            tab.remove();
            this.changeTab(this.firstTab);
        }
    };
});