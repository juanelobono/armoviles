var verAdministradoresActivos = function () {

    return {
        //main function to initiate the module
        init: function () {        	        	
            columnasTabla = [
                { "mData": "DT_RowId"},
                { "mData": "nombre" },
                { "mData": "usuario" },
                { "mData": "email" }
            ];

            urlEliminarRegistros = "administradores/eliminar.php";
            urlRegistrarNuevo = "pnlAdmin.php?subSeccion=NuevoAdministrador";
            urlModificarRegistro = "pnlAdmin.php?subSeccion=ModificarAdministrador&id=";            

            urlDatosTabla = "administradores/obtenerActivos.php";

            columnasDef = [];

            infoModificar = function(data){
                    return data.DT_RowId+" - "+data.nombre;
            };

            infoEliminar = function(data){
                    return data.DT_RowId+" - "+data.nombre+" </br>";
            };
        }
    };
}();