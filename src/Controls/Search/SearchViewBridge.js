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
        document.querySelector('.search-response').style.display = 'block';
        event.stopPropagation();
        return false;
    };

    document.onclick = function() {
        document.querySelector('.search-response').style.display = 'none';
    };
};

bridge.prototype.queryProducts = function(query) {
    this.raiseServerEvent('search', query, function(products){
        var text = '';
        for (var i = 0; i < products.length; i++) {
            text += '<a href="' + products[i].Href + '"><li>' + products[i].Name  + '</li>' + '</a>';
        }
        document.querySelector('.search-response').innerHTML = text;
    });
};

window.rhubarb.viewBridgeClasses.SearchViewBridge = bridge;
