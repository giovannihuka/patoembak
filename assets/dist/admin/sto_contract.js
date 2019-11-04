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
                    ajax: {"url": "sto_contract/json", "type": "POST"},
                    columns: [
                        {
                            "data": "sto_contractid",
                            "orderable": false
                        },
						{"data": "contractno"},
						{"data": "mid"},
						{"data": "ref_contracttypeid"},
						{"data": "registerdate"},
						{"data": "expirydate"},
						{"data": "name"},
						{"data": "address"},
						{"data": "ref_cityid"},
						{"data": "ref_provinceid"},
						{"data": "contact"},
						{"data": "email"},
						{"data": "phone"},
						{"data": "mobile1"},
						{"data": "mobile2"},
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