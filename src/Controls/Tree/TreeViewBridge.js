var bridge = function (leafPath) {
	window.rhubarb.viewBridgeClasses.ViewBridge.apply(this, arguments);
};

bridge.prototype = new window.rhubarb.viewBridgeClasses.ViewBridge();
bridge.prototype.constructor = bridge;

bridge.prototype.attachEvents = function () {
	$(this.viewNode).jstree(
		{
			"core" : {
				"animation" : 200,
				"check_callback" : true,
				"themes" : { "stripes" : true }
			},
			"types" : {
				"#" : {
					"max_children" : -1,
					"max_depth" : -1,
					"valid_children" : ["root"]
				},
				"root" : {
					"icon" : "/static/3.3.3/assets/images/tree_icon.png",
					"valid_children" : ["default"]
				},
				"default" : {
					"valid_children" : ["default","file"]
				},
				"file" : {
					"valid_children" : []
				}
			},
			"state": {
				"key":this.leafPath
			},
			'plugins':[
				"contextmenu", "dnd", "state", "types", "search", "unique"
			]
		}
	);
};

bridge.prototype.getValue = function() {
	return getIdsFromLiList($(this.viewNode).find('.jstree-container-ul').children('li'));
};

function getIdsFromLiList(list) {
	var ids = [];
	for (var i = 0; i < list.length; i++) {
		var current = $(list[i]);
		var id = current.find('input').val();
		var name = current.children('a').text();
		var children = current.find('ul').children('li');
		if (children.length) {
			var childIds = getIdsFromLiList(children);
			ids.push([id, childIds, name]);
		} else {
			ids.push([id, [], name]);
		}
	}
	return ids.reverse();
}

window.rhubarb.viewBridgeClasses.TreeViewBridge = bridge;
