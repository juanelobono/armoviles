<?php	

    if(!defined('acceso')){
            exit();
    }
?>

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
        <link href="../resources/css/themes/blue-inicio.css" rel="stylesheet" type="text/css"/>
	<link href="../resources/js/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
	<link href="../resources/js/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" type="text/css"/>   

	<!-- END GLOBAL MANDATORY STYLES -->
	<link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed">
	<!-- BEGIN HEADER -->   
	<div class="header navbar navbar-inverse navbar-fixed-top">
		<!-- BEGIN TOP NAVIGATION BAR -->
		<div class="navbar-inner">
			<div class="container-fluid">
				<!-- BEGIN LOGO -->
				<a class="brand" style="padding-top: 5px" href="pnlAdmin.php?seccion=Inicio">
                                    
                                    <img src="../resources/imagenes/logo.png" alt="logo" >
				</a>
				<!-- END LOGO -->
				<!-- BEGIN RESPONSIVE MENU TOGGLER -->
				<a href="javascript:;" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
				<img src="../resources/imagenes/menu-toggler.png" alt="" />
				</a>          
				<!-- END RESPONSIVE MENU TOGGLER -->            
				<!-- BEGIN TOP NAVIGATION MENU -->              
				
				<ul class="nav pull-right">
					
					<!-- BEGIN USER LOGIN DROPDOWN -->
					<li class="dropdown user">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                                <img alt="" src="../resources/imagenes/avatar.png" />						
                                                <span class="username"><?php echo $_SESSION['c_sesion_nombre']?></span>
                                                <i class="icon-angle-down"></i>
                                            </a>
                                            <ul class="dropdown-menu">							
                                                <li><a href="javascript:;" id="trigger_fullscreen"><i class="icon-move"></i>Pantalla Completa</a></li>							
                                                <li><a href="cerrarSesion.php"><i class="icon-key"></i> Salir</a></li>
                                            </ul>
					</li>
					<!-- END USER LOGIN DROPDOWN -->					
				</ul>

				<!-- END TOP NAVIGATION MENU --> 
			</div>
		</div>
		<!-- END TOP NAVIGATION BAR -->
	</div>
	<!-- END HEADER -->
	
	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
	<!-- BEGIN CORE PLUGINS -->   
        <script src="../resources/js/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
	<script src="../resources/js/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
	<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
        <script src="../resources/js/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js" type="text/javascript"></script>      
        <script src="../resources/js/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../resources/js/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript" ></script>
	<!--[if lt IE 9]>
	<script src="assets/plugins/excanvas.min.js"></script>
	<script src="assets/plugins/respond.min.js"></script>  
	<![endif]-->   
        <script src="../resources/js/plugins/gritter/js/jquery.gritter.min.js" type="text/javascript" ></script>
        <script src="../resources/js/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="../resources/js/plugins/jquery.blockui.min.js" type="text/javascript"></script>  
        <script src="../resources/js/plugins/jquery.cookie.min.js" type="text/javascript"></script>
        <script src="../resources/js/plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script>	
	<!-- END CORE PLUGINS -->
        <script src="../resources/js/scripts/app.js"></script>      
        <script type="text/javascript">
		jQuery(document).ready(function() {    
		   
		});
	</script>
	<!-- END JAVASCRIPTS -->
    </body>
<!-- END BODY -->
</html>