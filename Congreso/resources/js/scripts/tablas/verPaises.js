var verPaises = function () {

    return {
        //main function to initiate the module
        init: function () {        	        	
            columnasTabla = [
                { "mData": "DT_RowId"},
                { "mData": "nombre" }
            ];

            urlEliminarRegistros = "paises/eliminar.php";
            urlRegistrarNuevo = "pnlAdmin.php?subSeccion=NuevoPais";
            urlModificarRegistro = "pnlAdmin.php?subSeccion=ModificarPais&id=";            

            urlDatosTabla = "paises/obtenerTodos.php";

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