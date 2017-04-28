var ComportamientoSituacionLaboralcliente = function() {

    var clonUltimaFilaClear = null;
    

    function comportamientoUltimaFila() {
        $('#agregarFila').click(agregarFila);
        $('.eliminarFila').click(eliminarFila);
    }

    function agregarFila() {
        
        $("#agregarFila").unbind("click");
        $(".eliminarFila").unbind("click");

        var ultimaFila = $("#tbodySituacionLaboral tr:last");
        var clonUltimaFila = ultimaFila.clone();

        $("#agregarFila").remove();
        $("#tbodySituacionLaboral").append(clonUltimaFila);
        
        $(".nombre_empresa:last").val("");
        $(".antiguedad:last").val("");
        $(".ingresos_mensuales:last").val("");
        $(".condicion:last").val("");
        $(".domicilio_laboral:last").val("");
        $(".telefono_laboral:last").val("");
        $(".otros_ingresos:last").val("");
        
        
        comportamientoUltimaFila();

        
        
    }

    function eliminarFila() {
        var fila = $(this).parent().parent().parent();
        if ($('#tbodySituacionLaboral >tr').length > 1) {

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
        clonUltimaFilaClear = $("#tbodySituacionLaboral tr:last").clone();

        if ($("#tbodySituacionLaboral tr").length === 0) {
            $("#tbodySituacionLaboral").append(clonUltimaFilaClear);
        }
        comportamientoUltimaFila();

    }

    
    return {
        //main function to initiate the module
        init: function() {
            initComportamiento();
            
           
        },
        nuevaFila: function() {
            agregarFila();
        }
              
    };
}();