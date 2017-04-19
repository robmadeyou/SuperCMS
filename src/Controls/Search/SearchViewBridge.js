var bridge = function (leafPath) {
    window.rhubarb.viewBridgeClasses.ViewBridge.apply(this, arguments);
};

bridge.prototype = new window.rhubarb.viewBridgeClasses.ViewBridge();
bridge.prototype.constructor = bridge;

bridge.prototype.attachEvents = function () {
    var input = document.querySelector('#' + this.leafPath + '_Query');
    var categoryDropdown = document.querySelector('.search-categories');

    var self = this;
    var searchTimeout = null;
    input.onkeyup = function () {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(function(){
            self.queryProducts(input.value)
        }, 400);
    };

    input.onclick = function(event) {
        document.querySelector('.c-result-section').style.display = 'block';
        event.stopPropagation();
        return false;
    };

    document.onclick = function() {
        document.querySelector('.c-result-section').style.display = 'none';
    };
};

bridge.prototype.queryProducts = function(query) {
    this.raiseServerEvent('search', query, function(products){
        var text = '';
        for (var i = 0; i < products.length; i++) {
            var image = products[i].Thumbnail ? '<img src="' + products[i].Thumbnail + '">' : '';
            text += '<a href="' + products[i].Href + '"><li>' + image + '<span>' + products[i].Name  + '</span></li>' + '</a>';
        }
        document.querySelector('.search-response').innerHTML = text;
    });
};

window.rhubarb.viewBridgeClasses.SearchViewBridge = bridge;
