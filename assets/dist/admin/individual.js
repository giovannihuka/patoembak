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
                    lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                    pageLength: 10,
                    ajax: {"url": "individual/json", "type": "POST"},
                    columns: [
                        {
                            "data": "id",
                            "orderable": false
                        },
                        {
                            "data" : "action",
                            "orderable": false,
                            "className" : "text-center"
                        },
                        {"data": "individual_code"},
                        {"data": "full_name"},
						{"data": "nick_name"},
                        {"data": "gender_name"},
                        {"data": "blood_type"},
						// {
      //                       "data": "birth_date",
      //                       "render": function(data)
      //                       {
      //                           // return moment(data).format('D-MMMM-YYYY');
      //                           return moment(data).format('D-MMMM');
      //                       }
      //                   },
                        {"data": "birth_date"},
						// {"data": "birth_daynum"},
						// {"data": "birth_monthnum"},
						{"data": "birth_city"},
                        {"data": "status_name"},
						{"data": "phone_num"},
						{"data": "company_name"},
						{"data": "status_data"}
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
