var VerClientes = function () {

    return {
        //main function to initiate the module
        init: function () {        	        	
            columnasTabla = [
                { "mData": "DT_RowId" },
                { "mData": "nombre" },
                { "mData": "email" },
                { "mData": "localidad" },
                { "mData": "provincia" }
            ];

            urlEliminarRegistros = "clientes/eliminar.php";
            urlRegistrarNuevo = "pnlAdmin.php?subSeccion=NuevoCliente";
            urlModificarRegistro = "pnlAdmin.php?subSeccion=ModificarCliente&id=";            

            urlDatosTabla = "clientes/obtenerTodos.php";

            columnasDef = [];

            infoModificar = function(data){
                    return data.DT_RowId +" - "+data.nombre;
            }

            infoEliminar = function(data){
                     return data.DT_RowId +" - "+data.nombre +"</br>";
            }
        }
    };
}();