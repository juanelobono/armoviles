<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8" />
        <title>Bono Automotores</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />        
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="../resources/js/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="../resources/js/plugins/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>
	<link href="../resources/js/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="../resources/css/style-metro.css" rel="stylesheet" type="text/css"/>
	<link href="../resources/css/style.css" rel="stylesheet" type="text/css"/>
	<link href="../resources/css/style-responsive.css" rel="stylesheet" type="text/css"/>
        <link href="../resources/css/themes/brown.css" rel="stylesheet" type="text/css" id="style_color"/>
	<link href="../resources/js/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
	<link href="../resources/js/plugins/select2/select2_metro.css" rel="stylesheet" type="text/css"/>
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN PAGE LEVEL STYLES -->
	<link href="../resources/css/pages/login.css" rel="stylesheet" type="text/css"/>
	<!-- END PAGE LEVEL STYLES -->
	<link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
	<!-- BEGIN LOGO -->
	<div class="logo">
		<img src="" alt="" /> 
	</div>
	<!-- END LOGO -->
	<!-- BEGIN LOGIN -->
	<div class="content">
		<!-- BEGIN LOGIN FORM -->
		<form class="form-vertical login-form" id="frmLogin" method="post">
			<h3 class="form-title">Ingreso al sistema</h3>
			<div class="alert alert-danger hide">
                            <button class="close" data-dismiss="alert"></button>
                            Usuario o Contrase&ntilde;a incorrecta.
                        </div>
			<div class="control-group">
				<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
				<label class="control-label visible-ie8 visible-ie9">Usuario</label>
				<div class="controls">
                                    <div class="input-icon left">
                                        <i class="icon-user"></i>
                                        <input class="m-wrap placeholder-no-fix" type="text" autocomplete="off" placeholder="Usuario" name="usuario"/>
                                    </div>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label visible-ie8 visible-ie9">Contraseña</label>
				<div class="controls">
                                    <div class="input-icon left">
                                        <i class="icon-lock"></i>
                                        <input class="m-wrap placeholder-no-fix" type="password" autocomplete="off" placeholder="Contraseña" name="contrasenia"/>
                                    </div>
				</div>
			</div>
			<div class="form-actions">				
				<button id="btnIngreso" class="btn blue pull-right">
                                    Ingresar <i class="m-icon-swapright m-icon-white"></i>
				</button>            
			</div>
			<h6>Version 1.0</h6>
		</form>
		<!-- END LOGIN FORM -->		
	</div>
	<!-- END LOGIN -->
	<!-- BEGIN COPYRIGHT -->
	<div class="copyright">
		
	</div>
	<!-- END COPYRIGHT -->        
	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
	<!-- BEGIN CORE PLUGINS -->   
        <script src="../resources/js/plugins/jquery-1.10.1.min.js" type="text/javascript"></script>
        <script src="../resources/js/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
	<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
	<script src="../resources/js/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>      
	<script src="../resources/js/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="../resources/js/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript" ></script>
	<!--[if lt IE 9]>
	<script src="assets/plugins/excanvas.min.js"></script>
	<script src="assets/plugins/respond.min.js"></script>  
	<![endif]-->   
	<script src="../resources/js/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="../resources/js/plugins/jquery.blockui.min.js" type="text/javascript"></script>  
	<script src="../resources/js/plugins/jquery.cookie.min.js" type="text/javascript"></script>
	<script src="../resources/js/plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script>
	<!-- END CORE PLUGINS -->
	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<script src="../resources/js/plugins/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
	<script src="../resources/js/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
	<script src="../resources/js/plugins/select2/select2.min.js" type="text/javascript" ></script>
	<!-- END PAGE LEVEL PLUGINS -->
	
	      
	<!-- END PAGE LEVEL SCRIPTS --> 
	<script>
            jQuery(document).ready(function() {     
//              App.init();		  
            });

            $('#frmLogin').validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                rules: {                    
                    usuario: {
                        required: true
                    },
                    contrasenia: {
                        required: true
                    }
                },
                messages:{
                    usuario: {
                        required: "Campo Requerido"
                    },
                    contrasenia: {
                        required: "Campo Requerido"
                    }
                },
                highlight: function(element) { // hightlight error inputs
                    $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
                },
                success: function(label) {
                    label.closest('.form-group').removeClass('has-error');
                    label.remove();
                },
                errorPlacement: function(error, element) {
                    error.insertAfter(element.closest('.input-icon'));
                },
                submitHandler: function(form) {
                    $.ajax({
                        type: "POST",
                        url: "../controlador/iniciarSesion.php",
                        data: $("#frmLogin").serialize(),
                        success: function(data) {
                            if(data !== "exito"){
                                var $div_error = $('#frmLogin div:first');
                                $div_error.removeClass('hide');
                                window.location.replace("../index.php");
                            }else{
                                //
                                window.location.replace("../index.php");
                            }
                        }
                    });
                }
            });
	</script>
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>