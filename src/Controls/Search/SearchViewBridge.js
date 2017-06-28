var bridge = function (leafPath) {
    window.rhubarb.viewBridgeClasses.ViewBridge.apply(this, arguments);
};

bridge.prototype = new window.rhubarb.viewBridgeClasses.ViewBridge();
bridge.prototype.constructor = bridge;

bridge.prototype.attachEvents = function () {
    var input = document.querySelector('#' + this.leafPath + '_Query'),
        categoryDropdown = document.querySelector('.search-categories'),
        searchResults = document.querySelector('.c-result-section'),
        innerSearchResults = document.querySelector('.c-result-section-inner'),
        suggestedItems = document.querySelector('.c-suggested-items');

    var self = this;
    var searchTimeout = null;
    input.onkeyup = function () {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(function(){
            searchResults.style.display = 'block';
            self.queryProducts(input.value)
        }, 400);
    };

    input.onkeydown = function () {
        if (!innerSearchResults.classList.contains('ajax-progress')) {
            innerSearchResults.classList.add('ajax-progress');
        }
    };

    input.onclick = function(event) {
        if (input.value) {
            searchResults.style.display = 'block';
        }
        event.stopPropagation();
        return false;
    };

    input.onblur = function(event) {
        if (!event.relatedTarget || event.relatedTarget.tagName != 'A') {
            searchResults.style.display = 'none';
        }
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
        document.querySelector('.c-result-section-inner').classList.remove('ajax-progress');
    });
};

window.rhubarb.viewBridgeClasses.SearchViewBridge = bridge;
