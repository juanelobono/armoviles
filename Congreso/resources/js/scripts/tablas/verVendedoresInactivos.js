var verVendedoresInactivos = function () {

    return {
        //main function to initiate the module
        init: function () {        	        	
            columnasTabla = [
                { "mData": "DT_RowId"},
                { "mData": "nombre" },
                { "mData": "usuario" },
                { "mData": "email" },
                { "mData": "telefono"}
            ];

            urlEliminarRegistros = "vendedores/eliminar.php";
            urlRegistrarNuevo = "pnlAdmin.php?subSeccion=NuevoVendedor";
            urlModificarRegistro = "pnlAdmin.php?subSeccion=ModificarVendedor&id=";            

            urlDatosTabla = "vendedores/obtenerInactivos.php";

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