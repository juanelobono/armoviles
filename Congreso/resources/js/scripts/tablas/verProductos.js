var VerProductos = function () {

    return {
        //main function to initiate the module
        init: function () {        	        	
            columnasTabla = [
                { "mData": "DT_RowId" },
                { "mData": "nombre" },
                { "mData": "descripcion" },
                { "mData": "precio_sin_iva" },
                { "mData": "iva" },
                { "mData": "marca" },
                { "mData": "modelo" }
            ];

            urlEliminarRegistros = "productos/eliminar.php";
            urlRegistrarNuevo = "pnlAdmin.php?subSeccion=NuevoProducto";
            urlModificarRegistro = "pnlAdmin.php?subSeccion=ModificarProducto&id=";      
            urlImagenesRegistro = "pnlAdmin.php?subSeccion=ImagenProductos&idDB=";

            urlDatosTabla = "productos/obtenerTodos.php";

            columnasDef = [];

            infoModificar = function(data){
                    return data.DT_RowId +" - "+data.nombre;
            };

            infoEliminar = function(data){
                     return data.DT_RowId +" - "+data.nombre +"</br>";
            };
        }
    };
}();