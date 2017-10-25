rhubarb.vb.create('ProductItemViewBridge', function () {
    return {
        mainProductImage:null,
        thumbnailContainer:null,
        attachEvents: function () {
            var self = this;

            var variationDropdown = this.findChildViewBridge('Variations');

            self.mainProductImage = $('.c-main-product-image');
            self.thumbnailContainer = $('#thumbnail-container');

            $(variationDropdown.viewNode).change(function (event) {
                self.changeVariation(variationDropdown.getValue());
                event.preventDefault();
                return false;
            });

            $(this.viewNode).on('click', '.js-thubmnail', function() {
                self.selectThumbnail($(this));
            });

            var addToBasket = this.findChildViewBridge('AddToBasket');

            $(addToBasket.viewNode).click(function (event) {
                var parent = $(this).closest('div');
                parent.addClass('ajax-progress');
                self.raiseServerEvent('addToCart', function () {
                    parent.removeClass('ajax-progress');
                });
                event.preventDefault();
            });
        },
        changeVariation:function(id) {
            var self = this;

            this.model.selectedVariationId = id;
            this.saveState();

            this.raiseServerEvent('changeSelectedVariation', id, function(values) {
                var name = $('.c-product-variation-title');
                var desc = $('.c-product-variation-desc');

                name.html(values.Name);
                desc.html(desc);

                self.changeHeadImage(values.MainImage);
                self.thumbnailContainer.replaceWith(values.ImagesHTML);
            });
        },
        selectThumbnail:function(thumbnail) {
            this.thumbnailContainer.find('.selected').removeClass('selected');
            thumbnail.addClass('selected');
            this.changeHeadImage(thumbnail.find('img').attr('src'));
        },
        changeHeadImage:function(src) {
            this.mainProductImage.attr('src', src);
        }
    };
});
