var verProvincias = function () {

    return {
        //main function to initiate the module
        init: function () {        	        	
            columnasTabla = [
                { "mData": "DT_RowId"},
                { "mData": "nombre" },
                { "mData": "pais" }
            ];

            urlEliminarRegistros = "provincias/eliminar.php";
            urlRegistrarNuevo = "pnlAdmin.php?subSeccion=NuevaProvincia";
            urlModificarRegistro = "pnlAdmin.php?subSeccion=ModificarProvincia&id=";            

            urlDatosTabla = "provincias/obtenerTodas.php";

            columnasDef = [];

            infoModificar = function(data){
                    return "Código: "+data.DT_RowId;
            };

            infoEliminar = function(data){
                    return "C&oacute;digo: "+data.DT_RowId+ "</br>";
            };
        }
    };
}();