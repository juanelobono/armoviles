var VerVentas = function () {

    return {
        //main function to initiate the module
        init: function () {        	        	
            columnasTabla = [
                { "mData": "DT_RowId" },
                { "mData": "fecha_ingreso" },
                { "mData": "patente" },
                { "mData": "nombre_producto" },
                { "mData": "nombre_cliente" },
                { "mData": "monto_total" }
            ];

            urlEliminarRegistros = "ventas/eliminar.php";
            urlRegistrarNuevo = "pnlAdmin.php?subSeccion=NuevaVenta";
            urlModificarRegistro = "pnlAdmin.php?subSeccion=ModificarVenta&id="; 
            urlVerDetalle = "pnlAdmin.php?subSeccion=VerDetalle&id=";    
            urlImagenesRegistro = "pnlAdmin.php?subSeccion=ImagenVentas&idDB=";

            urlDatosTabla = "ventas/obtenerTodas.php";

            columnasDef = [];

            infoVerDetalle = function(data){
                return data.DT_RowId + " - "+data.patente;
            };

            infoModificar = function(data){
                    return data.DT_RowId +" - "+data.nombre;
            };

            infoEliminar = function(data){
                     return data.DT_RowId +" - "+data.nombre +"</br>";
            };
        }
    };
}();

