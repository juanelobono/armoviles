var verLocalidades = function () {

    return {
        //main function to initiate the module
        init: function () {        	        	
            columnasTabla = [
                { "mData": "DT_RowId"},
                { "mData": "nombre" },
                { "mData": "codigo_postal" },
                { "mData": "provincia" },
                { "mData": "pais" }
            ];

            urlEliminarRegistros = "localidades/eliminar.php";
            urlRegistrarNuevo = "pnlAdmin.php?subSeccion=NuevaLocalidad";
            urlModificarRegistro = "pnlAdmin.php?subSeccion=ModificarLocalidad&id=";            

            urlDatosTabla = "localidades/obtenerTodas.php";

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