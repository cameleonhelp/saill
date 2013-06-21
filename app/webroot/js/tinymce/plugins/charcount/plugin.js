/**
 * plugin.js
 *
 * Copyright, Moxiecode Systems AB
 * Released under LGPL License.
 *
 * License: http://www.tinymce.com/license
 * Contributing: http://www.tinymce.com/contributing
 */

/*global tinymce:true */

tinymce.PluginManager.add('charcount', function(editor) {
	var self = this, countre, cleanre;
        var max_chars = 191;

	countre = editor.getParam('charcount_countregex', /[\w\u2019\x27\-]+/g); // u2019 == &rsquo;
	cleanre = editor.getParam('charcount_cleanregex', /[0-9.(),;:!?%#$?\x27\x22_+=\\\/\-]*/g);

	function update() {
            var message  = self.getCount()<max_chars ? self.getCount() : 'Votre texte a atteint la limite.';
            editor.theme.panel.find('#charcount').text(['Caractères: {0}', message]);
            if (self.getCount()>=max_chars) alert('Votre message dépasse la taille limite de 190 caractères, il ne sera pas lisible sur des résolutions inférieure à 1280x1024');
	}

	editor.on('init', function() {
		var statusbar = editor.theme.panel && editor.theme.panel.find('#statusbar')[0];

		if (statusbar) {
			window.setTimeout(function() {
                                var message  = self.getCount()<max_chars ? self.getCount() : 'Votre texte a atteint la limite.';
				statusbar.insert({
					type: 'label',
					name: 'charcount',
					text: ['Caractères: {0}', message],
					classes: 'charcount'
				}, 0);

				editor.on('setcontent beforeaddundo', update);

				editor.on('keyup', function(e) {
                                    update();
				});
			}, 0);
		}
	});

	self.getCount = function() {
		var tx = editor.getContent({format: 'raw'});
		var tc = 0;

		if (tx) {
			// deal with html entities
			tx = tx.replace(/(\w+)(&.+?;)+(\w+)/, "$1$3").replace(/&.+?;/g, ' ');
                        tx = tx.replace(/<.[^<>]*?>/g, ' ').replace(/&nbsp;|&#160;/gi, ' '); // remove html tags and space chars

			// deal with html entities
			tx = tx.replace(/(\w+)(&.+?;)+(\w+)/, "$1$3").replace(/&.+?;/g, ' ');
                        tc = tx.length;
		}

		return tc;
	};
});