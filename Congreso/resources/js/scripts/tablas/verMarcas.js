var VerMarcas = function () {

    return {
        //main function to initiate the module
        init: function () {        	        	
            columnasTabla = [
                { "mData": "DT_RowId" },
                { "mData": "descripcion" },
                { "mData": "activo" }
                
            ];

            urlEliminarRegistros = "marcas/eliminar.php";
            urlRegistrarNuevo = "pnlAdmin.php?subSeccion=NuevaMarca";
            urlModificarRegistro = "pnlAdmin.php?subSeccion=ModificarMarca&id=";            

            urlDatosTabla = "marcas/obtenerTodas.php";

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