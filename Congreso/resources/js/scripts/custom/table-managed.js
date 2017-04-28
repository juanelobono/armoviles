var TableManaged = function () {

    return {

        //main function to initiate the module
        init: function () {
            
            if (!jQuery().dataTable) {
                return;
            }

            // begin first table
            $('#sample_1').dataTable({
                "aoColumns": [
                  { "bSortable": false },
                  null,
                  { "bSortable": false, "sType": "text" },
                  null,
                  { "bSortable": false },
                  { "bSortable": false }
                ],
                "aLengthMenu": [
                    [5, 15, 20, -1],
                    [5, 15, 20, "Todos"] // change per page values here
                ],
                // set the initial value
                "iDisplayLength": 5,
                "sPaginationType": "bootstrap",
                "oLanguage": {
                    "sProcessing": '<img src="assets/img/loading-spinner-grey.gif"/><span>&nbsp;&nbsp;Cargando...</span>',
                    "sLengthMenu": "Ver _MENU_ registros",
                    "sSearch": "Buscar:",
                    "sInfo": "Se encontraron _TOTAL_ registros",
                    "sInfoEmpty": "No se encontraron registros para mostrar.",
                    "sGroupActions": "_TOTAL_ registros seleccionados:  ",
                    "sAjaxRequestGeneralError": "No se pudo completar la solicitud. Por favor, compruebe su conexi&oacute;n a Internet",
                    "sEmptyTable":  "A&uacute;n no existen datos para la tabla.",
                    "sZeroRecords": "No existen registros para esta b&uacute;squeda.",
                    "sInfoFiltered": "(filtrados de _MAX_ registros).",
                    "oPaginate": {
                        "sPrevious": "Anterior",
                        "sNext": "Siguiente",
                        "sPage": "P&aacute;g",
                        "sPageOf": "de"
                    }                    
                   /* "sLengthMenu": "_MENU_ records",
                    "oPaginate": {
                        "sPrevious": "Anterior",
                        "sNext": "Siguiente"
                    }*/
                },
                "aoColumnDefs": [
                    { 'bSortable': false, 'aTargets': [0] },
                    { "bSearchable": false, "aTargets": [ 0 ] }
                ]
            });

            jQuery('#sample_1 .group-checkable').change(function () {
                var set = jQuery(this).attr("data-set");
                var checked = jQuery(this).is(":checked");
                jQuery(set).each(function () {
                    if (checked) {
                        $(this).attr("checked", true);
                        $(this).parents('tr').addClass("active");
                    } else {
                        $(this).attr("checked", false);
                        $(this).parents('tr').removeClass("active");
                    }                    
                });
                jQuery.uniform.update(set);
            });

            jQuery('#sample_1').on('change', 'tbody tr .checkboxes', function(){
                 $(this).parents('tr').toggleClass("active");
            });

            jQuery('#sample_1_wrapper .dataTables_filter input').addClass("form-control input-medium input-inline"); // modify table search input
            jQuery('#sample_1_wrapper .dataTables_length select').addClass("form-control input-xsmall"); // modify table per page dropdown
            //jQuery('#sample_1_wrapper .dataTables_length select').select2(); // initialize select2 dropdown
        }

    };

}();