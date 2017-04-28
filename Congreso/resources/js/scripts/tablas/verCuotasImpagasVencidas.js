var VerCuotasImpagasVencidas = function () {

    return {
        //main function to initiate the module
        init: function () {        	        	
            columnasTabla = [
                { "mData": "DT_RowId" },
                { "mData": "fecha_vencimiento" },
                { "mData": "monto" },
                { "mData": "nombre_cliente" },
                { "mData": "patente" },
                { "mData": "nombre_vehiculo" }
            ];

            urlEliminarRegistros = "ventas/eliminar.php";
            urlRegistrarNuevo = "pnlAdmin.php?subSeccion=NuevaVenta";
            urlModificarRegistro = "pnlAdmin.php?subSeccion=ModificarVenta&id="; 
            urlVerDetalle = "pnlAdmin.php?subSeccion=VerDetalle&id=";    
            urlImagenesRegistro = "pnlAdmin.php?subSeccion=ImagenVentas&idDB=";

            urlDatosTabla = "cuotas/obtenerTodasImpagasVencidas.php";

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

