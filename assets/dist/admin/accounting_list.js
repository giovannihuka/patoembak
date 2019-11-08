$(document).on({
    change: function() {
        var ref_inoutid = $(this).val();
        if(ref_inoutid){
            $.ajax({
                type:'POST',
                url:'accounting/get_categorylist',
                data:'province_id=' + ref_inoutid,
                success:function(data){
                    $('#ref_regencies').parent().parent().html(data);
                    $('#ref_regencies').trigger("change");
                    $('#ref_districts').trigger("change");
                    $('#ref_villages').trigger("change");
                }
            }); 
        } 
    }
}, "#ref_provinceid");

$(document).on({
    change: function() {
        var regency_id = $(this).val();
        if(regency_id){
            $.ajax({
                type:'POST',
                url:'familie/get_districtlist',
                data:'regency_id=' + regency_id,
                success:function(data){
                    $('#ref_districts').parent().parent().html(data);
                    $('#ref_districts').trigger("change");
                    $('#ref_villages').trigger("change");
                }
            }); 
        }
    }
}, "#ref_regencies");

$(document).on({
    change: function() {
        var district_id = $(this).val();
        if(district_id){
            $.ajax({
                type:'POST',
                url:'familie/get_villagelist',
                data:'district_id=' + district_id,
                success:function(data){
                    $('#ref_villages').parent().parent().html(data);
                    $('#ref_villages').trigger("change");
                }
            }); 
        } 
    }
}, "#ref_districts");

