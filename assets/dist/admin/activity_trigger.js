$(document).on({
    change: function() {
        var ref_activityid = $(this).val();
        var time_start = document.getElementById('time_start');
        var time_end = document.getElementById('time_end');
        // console.log(ref_activityid);
        // if(ref_activityid === '1'){
        // 	time_start.value = '08:00';
        // 	time_end.value = '10:00';
        // } else {
        // 	window.alert('NOT OK');
        // };

        switch (ref_activityid) {
        	case '1':
        		time_start.value = '08:00';
        		time_end.value = '10:00';
        	break;
        	case '2':
        		time_start.value = '08:00';
        		time_end.value = '10:00';
        	break;
        	case '3':
        		time_start.value = '20:00';
        		time_end.value = '22:00';
        	break;
        	case '4':
        		time_start.value = '18:00';
        		time_end.value = '20:00';
        	break;
            case '20':
                time_start.value = '07:00';
                time_end.value = '08:00';
            break;
            case '21':
                time_start.value = '20:00';
                time_end.value = '21:00';
            break;
        	default:
        		time_start.value = '08:00';
        		time_end.value = '10:00';

        }
    }
}, "#ref_activityid");