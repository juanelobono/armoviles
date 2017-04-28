var ImagenesProducto = function () {

    return {
        //main function to initiate the module
        init: function () {

            // Initialize the jQuery File Upload widget:
            $('#fileupload').fileupload({
                // Uncomment the following to send cross-domain cookies:
                //xhrFields: {withCredentials: true},
//                url: '/noticias/resources/js/plugins/jquery-file-upload/server/php/index.php'
                url: '../resources/js/scripts/custom/imagenes/index.php?idDB=' + _idDB,
                maxFileSize: 1000000,
                acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i
            });

            // Load existing files:
            // Demo settings:
            $.ajax({
                // Uncomment the following to send cross-domain cookies:
                //xhrFields: {withCredentials: true},
                url: $('#fileupload').fileupload('option', 'url'),
                dataType: 'json',
                context: $('#fileupload')[0],
                maxFileSize: 100000,
                acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
                process: [{
                        action: 'load',
                        fileTypes: /^image\/(gif|jpeg|png)$/,
                        maxFileSize: 100000 // 20MB
                    }, {
                        action: 'resize',
                        maxWidth: 1440,
                        maxHeight: 900
                    }, {
                        action: 'save'
                    }
                ]
            }).done(function (result) {
                $(this).fileupload('option', 'done')
                    .call(this, null, {
                    result: result
                });
            });

            // initialize uniform checkboxes  
            App.initUniform('.fileupload-toggle-checkbox');
            
            $("#btnFinalizar").click(function(){
            	parent.history.back();
            });
        }
    };
}();
