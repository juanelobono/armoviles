var VerCategorias = function () {

    return {
        //main function to initiate the module
        init: function () {        	        	
            columnasTabla = [
                { "mData": "DT_RowId" },
                { "mData": "nombre" },
                { "mData": "descripcion" },
                { "mData": "padre" }
            ];

            urlEliminarRegistros = "categorias/eliminar.php";
            urlRegistrarNuevo = "pnlAdmin.php?subSeccion=NuevaCategoria";
            urlModificarRegistro = "pnlAdmin.php?subSeccion=ModificarCategoria&id=";            

            urlDatosTabla = "categorias/obtenerTodas.php";

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