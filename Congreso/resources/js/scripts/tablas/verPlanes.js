var VerPlanes = function () {

    return {
        //main function to initiate the module
        init: function () {        	        	
            columnasTabla = [
                { "mData": "DT_RowId" },
                { "mData": "nombre" },
                { "mData": "cuotas" },
                { "mData": "interes" },
                { "mData": "activo" }
            ];

            urlEliminarRegistros = "planpago/eliminar.php";
            urlRegistrarNuevo = "pnlAdmin.php?subSeccion=NuevoPlan";
            urlModificarRegistro = "pnlAdmin.php?subSeccion=ModificarPlan&id=";      

            urlDatosTabla = "planpago/obtenerTodos.php";

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