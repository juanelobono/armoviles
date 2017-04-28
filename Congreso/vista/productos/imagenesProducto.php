<html>
    <head>

        <link href="../resources/js/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet"/> 
        <link href="../resources/js/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" />
    </head>
    <body>
        <!-- BEGIN CONTENT -->
        <div class="page-content">
            <div class="container-fluid">   
                <!-- BEGIN PAGE HEADER-->
                <div class="row-fluid">
                    <div class="span12">
                        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                        <h3 class="page-title">
                            
                        </h3>
                        <ul class="page-breadcrumb breadcrumb">                            
                            <li>
                                <i class="icon-home"></i>
                                <a href="#">
                                    Inicio
                                </a>
                                <i class="icon-angle-right"></i>
                            </li>
                            <li>
                                <a href="#">
                                    Producto
                                </a>
                                <i class="icon-angle-right"></i>
                            </li>
                            <li>
                                <a href="#">
                                    Im&aacute;genes
                                </a>
                            </li>
                        </ul>
                        <!-- END PAGE TITLE & BREADCRUMB-->
                    </div>
                </div>
                <!-- END PAGE HEADER-->
                <!-- BEGIN PAGE CONTENT-->
                <div class="row-fluid">
                    <div class="span12">
                        <div class="portlet box green">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-picture"></i>Im&aacute;genes
                                </div>
                                <div class="tools">

                                </div>
                            </div>
                            <div class="portlet-body form">
                                <form id="fileupload" action="#" method="POST" enctype="multipart/form-data">
                                    <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                                    <div class="row-fluid fileupload-buttonbar">
                                        <div class="span7">
                                            <!-- The fileinput-button span is used to style the file input field as button -->
                                            <span class="btn green fileinput-button">
                                                <i class="icon-plus"></i>
                                                <span>
                                                    Agregar
                                                </span>
                                                <input type="file" name="files[]" multiple="">
                                            </span>
                                            <button type="submit" class="btn blue start">
                                                <i class="icon-upload"></i>
                                                <span>
                                                    Subir
                                                </span>
                                            </button>
                                            <button type="reset" class="btn warning cancel">
                                                <i class="icon-ban-circle"></i>
                                                <span>
                                                    Cancelar
                                                </span>
                                            </button>
                                            <button type="button" class="btn red delete">
                                                <i class="icon-trash"></i>
                                                <span>
                                                    Eliminar
                                                </span>
                                            </button>
                                            <input type="checkbox" class="toggle">
                                            <!-- The global file processing state -->
                                            <span class="fileupload-process">
                                            </span>
                                        </div>
                                        <!-- The global progress information -->
                                        <div class="span5 fileupload-progress fade">
                                            <!-- The global progress bar -->
                                            <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                                <div class="bar" style="width:0%;"></div>
                                            </div>
                                            <!-- The extended global progress information -->
                                            <div class="progress-extended">
                                                &nbsp;
                                            </div>
                                        </div>
                                    </div>
                                    <!-- The loading indicator is shown during file processing -->
                                    <div class="fileupload-loading"></div>
                                    <br>
                                    <!-- The table listing the files available for upload/download -->
                                    <table role="presentation" class="table table-striped">
                                        <tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery"></tbody>
                                    </table>
                                </form>                                
                                <div class="well">
                                    <h3>Notas</h3>
                                    <ul>
                                        <li>
                                            El tama&ntilde;o m&aacute;ximo de la imagen a subir es de <strong>1 MB</strong>.                                  
                                        </li>
                                        <li>
                                            Solo se permiten archivos de imagen (<strong>JPG, GIF, PNG</strong>).
                                        </li
                                    </ul>
                                </div>

                            </div>                      
                        </div>
                        <div class="row-fluid">
                            <div class="span12">
                                <script id="template-upload" type="text/x-tmpl">
                                    {% for (var i=0, file; file=o.files[i]; i++) { %}
                                    <tr class="template-upload fade">
                                    <td class="preview"><span class="fade"></span></td>
                                    <td class="name"><span>{%=file.name%}</span></td>
                                    <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
                                    {% if (file.error) { %}
                                    <td class="error" colspan="2"><span class="label label-important">Error</span> {%=file.error%}</td>
                                    {% } else if (o.files.valid && !i) { %}
                                    <td>
                                    <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="bar" style="width:0%;"></div></div>
                                    </td>
                                    <td class="start">{% if (!o.options.autoUpload) { %}
                                    <button class="btn">
                                    <i class="icon-upload icon-white"></i>
                                    <span>Subir</span>
                                    </button>
                                    {% } %}</td>
                                    {% } else { %}
                                    <td colspan="2"></td>
                                    {% } %}
                                    <td class="cancel">{% if (!i) { %}
                                    <button class="btn red">
                                    <i class="icon-ban-circle icon-white"></i>
                                    <span>Cancelar</span>
                                    </button>
                                    {% } %}</td>
                                    </tr>
                                    {% } %}
                                </script>
                                <!-- The template to display files available for download -->
                                <script id="template-download" type="text/x-tmpl">
                                    {% for (var i=0, file; file=o.files[i]; i++) { %}
                                    <tr class="template-download fade">
                                    {% if (file.error) { %}
                                    <td></td>
                                    <td class="name"><span>{%=file.name%}</span></td>
                                    <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
                                    <td class="error" colspan="2"><span class="label label-important">Error</span> {%=file.error%}</td>
                                    {% } else { %}
                                    <td class="preview">
                                    {% if (file.thumbnail_url) { %}
                                    <a class="fancybox-button" data-rel="fancybox-button" href="{%=file.url%}" title="{%=file.name%}">
                                    <img src="{%=file.thumbnail_url%}">
                                    </a>
                                    {% } %}</td>
                                    <td class="name">
                                    <a href="{%=file.url%}" title="{%=file.name%}" data-gallery="{%=file.thumbnail_url&&'gallery'%}" download="{%=file.name%}">{%=file.name%}</a>
                                    </td>
                                    <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
                                    <td colspan="2"></td>
                                    {% } %}
                                    <td class="delete">
                                    <button class="btn red" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}"{% if (file.delete_with_credentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                                    <i class="icon-trash icon-white"></i>
                                    <span>Eliminar</span>
                                    </button>
                                    <input type="checkbox" class="fileupload-checkbox hide" name="delete" value="1">
                                    </td>
                                    </tr>
                                    {% } %}
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END PAGE CONTENT-->
            </div>
        </div>
        <!-- END CONTENT -->
    </div>
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    <div class="footer">
        <div class="footer-inner">
            2014 &copy; Metronic by keenthemes.
        </div>
        <div class="footer-tools">
            <span class="go-top">
                <i class="fa fa-angle-up"></i>
            </span>
        </div>
    </div>
    <!-- END FOOTER --> 

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="../resources/js/plugins/fancybox/source/jquery.fancybox.pack.js"></script>
    <!-- BEGIN:File Upload Plugin JS files-->
    <script src="../resources/js/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js"></script>
    <!-- The Templates plugin is included to render the upload/download listings -->
    <script src="../resources/js/plugins/jquery-file-upload/js/vendor/tmpl.min.js"></script>
    <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
    <script src="../resources/js/plugins/jquery-file-upload/js/vendor/load-image.min.js"></script>
    <!-- The Canvas to Blob plugin is included for image resizing functionality -->
    <script src="../resources/js/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js"></script>
    <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
    <script src="../resources/js/plugins/jquery-file-upload/js/jquery.iframe-transport.js"></script>
    <!-- The basic File Upload plugin -->
    <script src="../resources/js/plugins/jquery-file-upload/js/jquery.fileupload.js"></script>
    <!-- The File Upload file processing plugin -->
    <script src="../resources/js/plugins/jquery-file-upload/js/jquery.fileupload-fp.js"></script>
    <!-- The File Upload user interface plugin -->
    <script src="../resources/js/plugins/jquery-file-upload/js/jquery.fileupload-ui.js"></script>
    <!-- The XDomainRequest Transport is included for cross-domain file deletion for IE8+ -->
    <!--[if gte IE 8]><script src="assets/plugins/jquery-file-upload/js/cors/jquery.xdr-transport.js"></script><![endif]-->
    <!-- END:File Upload Plugin JS files-->   

    <script src="../resources/js/scripts/custom/imagenesProducto.js"></script>
    <script>
        var _idDB = '<?php if (!empty($_GET["idDB"])) {echo $_GET["idDB"];} else {echo '0';} ?>';
        
        jQuery(document).ready(function() {
            // initiate layout and plugins
            ImagenesProducto.init();
        });
    </script>
    <!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>

