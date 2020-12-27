(function () {
  'use strict'

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

  feather.replace();

    $.extend( true, $.fn.dataTable.defaults, {
        language:{
            url:  '/assets/plugins/datatables/tr.json'
        }
    } );

}())
