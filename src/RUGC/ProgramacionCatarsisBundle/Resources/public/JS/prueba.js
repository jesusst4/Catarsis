$(document).ready(function() {

    var idioma = $('#idioma').val();
    if (idioma === 'es') {
        jQuery(function($) {
            $.datepicker.regional['es'] = {
                changeMonth: true,
                changeYear: true,
                closeText: 'Cerrar',
                prevText: '&#x3c;Ant',
                nextText: 'Sig&#x3e;',
                currentText: 'Hoy',
                monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                    'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun',
                    'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                dateFormat: 'MM yy', };
            $.datepicker.setDefaults($.datepicker.regional['es']);
        });
    }
    else {
        jQuery(function($) {
            $.datepicker.regional['en'] = {
                changeMonth: true,
                changeYear: true,
                closeText: 'Done',
                prevText: 'Prev',
                nextText: 'Next',
                currentText: 'Today',
                monthNames: ['January', 'February', 'March', 'April', 'May', 'June',
                    'July', 'August', 'September', 'October', 'November', 'December'],
                monthNamesShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                dateFormat: 'MM yy', };
            $.datepicker.setDefaults($.datepicker.regional['en']);
        });

    }


    $('#txtDate').datepicker({
//        changeMonth: true,
//        changeYear: true,
//        dateFormat: 'MM yy',
//        monthNamesShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
//        monthNames:  ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
//        nextText: "Siguiente",
//        prevText: "Anterior",

        onClose: function() {
            var iMonth = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var iYear = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).datepicker('setDate', new Date(iYear, iMonth, 1));
        },
        beforeShow: function() {
            if ((selDate = $(this).val()).length > 0)
            {
                iYear = selDate.substring(selDate.length - 4, selDate.length);
                iMonth = jQuery.inArray(selDate.substring(0, selDate.length - 5), $(this).datepicker('option', 'monthNames'));
                $(this).datepicker('option', 'defaultDate', new Date(iYear, iMonth, 1));
                $(this).datepicker('setDate', new Date(iYear, iMonth, 1));
            }
        }

    });
});