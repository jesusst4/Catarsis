tinymce.PluginManager.add('imgsurfer', function(editor, url) {
	// Add a button that opens a window
	editor.addButton('imgsurfer', {
		text: 'Insert',
		icon: 'image',
		onclick: function() {
			// Open window
			editor.windowManager.open({
				title: 'Insertar imagen',
				width: 500,
			    height: 415,
			    file: url + "/main.php"
			});

			window.imgsurfer_activeEditor = editor;
		}
	});

});