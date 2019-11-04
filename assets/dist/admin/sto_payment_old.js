// $(document).ready(function() {
//                 $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
//                 {
//                     return {
//                         "iStart": oSettings._iDisplayStart,
//                         "iEnd": oSettings.fnDisplayEnd(),
//                         "iLength": oSettings._iDisplayLength,
//                         "iTotal": oSettings.fnRecordsTotal(),
//                         "iFilteredTotal": oSettings.fnRecordsDisplay(),
//                         "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
//                         "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
//                     };
//                 };

//                 var t = $("#mytable").dataTable({
//                     initComplete: function() {
//                         var api = this.api();
//                         $('#mytable_filter input')
//                                 .off('.DT')
//                                 .on('keyup.DT', function(e) {
//                                     if (e.keyCode == 13) {
//                                         api.search(this.value).draw();
//                             }
//                         });
//                     },
//                     oLanguage: {
//                         sProcessing: "loading..."
//                     },
//                     processing: true,
//                     serverSide: true,
//                     stateSave: true,
//                     lengthMenu: [[10, 50, 100, -1], [10, 50, 100, "All"]],
//                     pageLength: 10,
//                     ajax: {"url": "sto_payment/json", "type": "POST"},
//                     columns: [
//                         {
//                             "data": "sto_paymentid",
//                             "orderable": false
//                         },
// 						{"data": "sto_orderid"},
// 						{"data": "sto_storeid"},
// 						{"data": "sto_sessionid"},
// 						{"data": "ref_paymentcategoryid"},
// 						{"data": "ref_currencyid"},
// 						{"data": "ref_eventid"},
// 						{"data": "paymentdate"},
// 						{"data": "amount"},
// 						{"data": "discamount"},
// 						{"data": "freeamount"},
// 						{"data": "taxamount"},
// 						{"data": "retributionamount"},
// 						{"data": "serviceamount"},
// 						{"data": "totalamount"},
// 						{"data": "paidamount"},
// 						{"data": "changeamount"},
// 						{"data": "glo_bankid"},
// 						{"data": "ref_paymenttypeid"},
// 						{"data": "tax_servicechargeid"},
// 						{"data": "reversalflag"},
// 						{"data": "cardno"},
// 						{"data": "approvalno"},
// 						{"data": "trx_no"},
// 						{"data": "status"},
// 						{"data": "createid"},
// 						{"data": "updateid"},
// 						{"data": "createtime"},
// 						{"data": "updatetime"},
//                         {
//                             "data" : "action",
//                             "orderable": false,
//                             "className" : "text-center"
//                         }
//                     ],
//                     order: [[0, 'desc']],
//                     rowCallback: function(row, data, iDisplayIndex) {
//                         var info = this.fnPagingInfo();
//                         var page = info.iPage;
//                         var length = info.iLength;
//                         var index = page * length + (iDisplayIndex + 1);
//                         $('td:eq(0)', row).html(index);
//                     }
//                 });
//             });


$(document).ready(function() {
    $('#mytable').DataTable( {
        serverSide: true,
        ordering: false,
        searching: false,
        // dom: 'lBfrtip',
        oLanguage: {
            sProcessing: "loading..."
        },
        ajax:{"url": "sto_payment/json", "type": "POST"},
        deferRender:    true,
        scrollY:        200,
        scrollCollapse: true,
        scroller: {
            loadingIndicator: true,
            // displayBuffer: 20,
            // boundaryScale: 0.75
        },
        stateSave: true
    } );
} );