(function() {
    tinymce.create('tinymce.plugins.ForexBroker', {
        init : function(ed, url) {
        	var counter = jQuery("#symbols_count");
            ed.addButton('forex_broker', {
                title : 'Таблица форекс брокеров',
                image : url+'/../images/forex.png',
                onclick : function() {
                	ed.execCommand('mceInsertContent', false, '[forex_broker]');
                }
            });
			ed.onInit.add(function(ed, e) {

				if(counter != null)
					counter.text(ed.contentDocument.body.textContent.length);
			});
			ed.onEvent.add(function(ed, e) {
				if(counter != null)
					counter.text(ed.contentDocument.body.textContent.length);
			});
			ed.onChange.add(function(ed, e) {
				if(counter != null)
					counter.text(ed.contentDocument.body.textContent.length);
			});
        },
        createControl : function(n, cm) {
            return null;
        },
        getInfo : function() {
            return {
                longname : "Форекс Брокеры",
                author : 'jMadhead',
                authorurl : '',
                infourl : '',
                version : "1.0"
            };
        }
    });
    tinymce.PluginManager.add('forex_broker', tinymce.plugins.ForexBroker);
})();