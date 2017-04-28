var comportamientoTablaEntregas = function() {

    var clonUltimaFilaClear = null;

    function comportamientoUltimaFila() {

        $('#agregarFila').click(agregarFila);
        $('.eliminarFila').click(eliminarFila);
    }

    function agregarFila() {
        
        $("#agregarFila").unbind("click");
        $(".eliminarFila").unbind("click");

        var ultimaFila = $("#tbodyPrecios tr:last");
        var clonUltimaFila = ultimaFila.clone();

        $("#agregarFila").remove();
        $("#tbodyPrecios").append(clonUltimaFila);
        
        $(".importe_entrega:last").val("");
        $(".numero:last").val("");
        $(".banco:last").val("");
        $(".nombre_persona:last").val("");
        
        comportamientoUltimaFila();
    }

    function eliminarFila() {
        var fila = $(this).parent().parent().parent();
        if ($('#tbodyPrecios >tr').length > 1) {

            if ($(fila).find("#agregarFila").length) {

                var btnAgregar = $("#agregarFila");
                $(this).parent().parent().parent().remove();

                $(".operacionesFila:last").append(btnAgregar);

                comportamientoUltimaFila();

            } else {
                $(this).parent().parent().parent().remove();
            }
        }
    }

    function initComportamiento() {
        clonUltimaFilaClear = $("#tbodyPrecios tr:last").clone();

        if ($("#tbodyPrecios tr").length === 0) {
            $("#tbodyPrecios").append(clonUltimaFilaClear);
        }
        comportamientoUltimaFila();

    }

    return {
        //main function to initiate the module
        init: function() {
            initComportamiento();
           /* $("#tipo").change(function (){
            var tipoEntrega = $("#tipo").val();

            switch(tipoEntrega){
                case "Efectivo":
                    $("#numero").attr('readOnly',true);
                    $("#banco").attr('readOnly',true);
                    $("#nombre_persona").attr('readOnly',true);
                    
                    break;
                case "Cheque":
                    $("#numero").attr('readOnly',false);
                    $("#banco").attr('readOnly',false);
                    $("#nombre_persona").attr('readOnly',false);
                    
                    break;
                case "Tarjeta":
                    $("#numero").attr('readOnly',false);
                    $("#banco").attr('readOnly',false);
                    $("#nombre_persona").attr('readOnly',false);
                    
                    break;
                default:
                    break;


            }
        });*/
        },
        nuevaFila: function() {
            agregarFila();
        }

        
    };
}();