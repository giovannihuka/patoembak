$(document).ready(function() {
                $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
                {
                    return {
                        "iStart": oSettings._iDisplayStart,
                        "iEnd": oSettings.fnDisplayEnd(),
                        "iLength": oSettings._iDisplayLength,
                        "iTotal": oSettings.fnRecordsTotal(),
                        "iFilteredTotal": oSettings.fnRecordsDisplay(),
                        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
                    };
                };

                var t = $("#mytable").dataTable({
                    initComplete: function() {
                        var api = this.api();
                        $('#mytable_filter input')
                                .off('.DT')
                                .on('keyup.DT', function(e) {
                                    if (e.keyCode == 13) {
                                        api.search(this.value).draw();
                            }
                        });
                    },
                    oLanguage: {
                        sProcessing: "loading..."
                    },
                    processing: true,
                    serverSide: true,
                    stateSave: true,
                    lengthMenu: [[10, 50, 100, -1], [10, 50, 100, "All"]],
                    pageLength: 10,
                    ajax: {"url": "sto_store/json", "type": "POST"},
                    columns: [
                        {
                            "data": "sto_storeid",
                            "orderable": false
                        },
						{"data": "sto_contractid"},
						{"data": "shortname"},
						{"data": "logo"},
						{"data": "logo_print"},
						{"data": "name"},
						{"data": "email"},
						{"data": "phone"},
						{"data": "latitude"},
						{"data": "longitude"},
						{"data": "note"},
						{"data": "address"},
						{"data": "prt_device"},
						{"data": "prt_kitchen"},
						{"data": "ref_cityid"},
						{"data": "ref_storetypeid"},
						{"data": "ref_eventid"},
						{"data": "ref_provinceid"},
						{"data": "tax_governmentid"},
						{"data": "tax_businessid"},
						{"data": "tax_nationalid"},
						{"data": "tax_servicechargeid"},
						{"data": "ref_currencyid"},
						{"data": "taxno"},
						{"data": "taxname"},
						{"data": "taxaddress"},
						{"data": "taxregisterdate"},
						{"data": "tax_used"},
						{"data": "takeaway_used"},
						{"data": "status"},
						{"data": "createid"},
						{"data": "updateid"},
						{"data": "createtime"},
						{"data": "updatetime"},
                        {
                            "data" : "action",
                            "orderable": false,
                            "className" : "text-center"
                        }
                    ],
                    order: [[0, 'desc']],
                    rowCallback: function(row, data, iDisplayIndex) {
                        var info = this.fnPagingInfo();
                        var page = info.iPage;
                        var length = info.iLength;
                        var index = page * length + (iDisplayIndex + 1);
                        $('td:eq(0)', row).html(index);
                    }
                });
            });