var VerModelos = function () {

    return {
        //main function to initiate the module
        init: function () {        	        	
            columnasTabla = [
                { "mData": "DT_RowId" },
                { "mData": "descripcion" },
                { "mData": "descripcion_marca" },
                { "mData": "activo" }
                
            ];

            urlEliminarRegistros = "modelos/eliminar.php";
            urlRegistrarNuevo = "pnlAdmin.php?subSeccion=NuevaModelo";
            urlModificarRegistro = "pnlAdmin.php?subSeccion=ModificarModelo&id=";            

            urlDatosTabla = "modelos/obtenerTodas.php";

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