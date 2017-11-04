scms.create('DropzoneViewBridge', function(){
	return {
        attachEvents:function() {
            var self = this;
            var timeout;
            var path = $('.dropzone-post-url').val();
            var dz = new window.Dropzone("div#" + this.leafPath + ' div', {
                url:path,
                parallelUploads: 100,
                init: function() {
                    this.on('queuecomplete', function(file) {
                        var files = this.files;
                        for(var i = 0; i < files.length; i++) {
                            files[i].imageSrc = $(this.files[i].previewElement).find('img').attr('src');
                        }
                        self.raiseProgressiveServerEvent('fileUploadedEvent', path);
                    })
                },
                previewTemplate: self.viewNode.querySelector('.dz-template').innerHTML
            });

            dz.on("addedfile", function(file) {
                refreshGridly();
            });

            $('.dz-close-button').click(function() {
                var image = $(this).parent().find('.dz-image img').attr('src');
                var element = $(this);
                self.raiseProgressiveServerEvent('deleteImage', image, function() {
                    element.parent().remove();
                });
            });

            var gridly = $.extend(true, {}, getGridlySettings(), {
                callbacks: {
                    reordered: reorderImages
                }
            });

            $('#' + this.leafPath + ' .gridly .brick').width(gridly.base).height(gridly.base);

            $('#' + this.leafPath + ' .gridly').gridly(gridly);

            function refreshGridly() {
                $('#' + self.leafPath + ' .gridly').gridly('refresh', getGridlySettings());
            }

            function getGridlySettings() {
                var gridWidth = $('.gridly').width();
                var columns = Math.round(gridWidth / 140);
                var base = Math.round((gridWidth - (20 * columns)) / columns);
                return {
                    base: base,
                    gutter: 20,
                    columns: columns
                };
            }

            function reorderImages(order, a, b) {
                var imageList = [];
                order.each(function(){
                    imageList.push($(this).data('id'));
                });
                self.raiseProgressiveServerEvent('imageReorder', imageList);
            }

            $(window).resize(function(){
                // buffer execution by 50ms
                // this way we dont do multiple resizes
                // if user keeps resizing browser window
                clearTimeout(timeout);
                timeout = setTimeout(refreshGridly, 50);
            });
            refreshGridly();
        }
	}
});
