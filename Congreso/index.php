<?php
	session_start();
        
	if(empty($_SESSION['c_sesion_user'])){		
            header("Location: vista/login.php");
	}else{
            header("Location: controlador/pnlAdmin.php");		
	}
?>