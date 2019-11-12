<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Common_model extends MY_Model
{

    function __construct()
    {
        parent::__construct();
    }

    /*
     *  Dropdown list nama client
     */
    function contract_list()
    {
        $this->db->from('contracts');
        $this->db->where('terminate_date is null');
        $this->db->order_by('company_name','asc');
        $result = $this->db->get();

        $return = array();
        $return[0] = '-- Pilih Gereja Cabang --';

        if ($result->num_rows() > 0) 
        {
            foreach ($result->result_array() as $row) {
                # code...
                $return[$row['contract_id']] = $row['company_name'];
            }
        }

        return $return;

    }

    function contract_status()
    {
        $this->db->from('ref_constatus');
        $this->db->order_by('contract_statusid','asc');
        $result = $this->db->get();

        $return = array();
        $return[0] = '-- Pilih Status --';

        if ($result->num_rows() > 0) 
        {
            foreach ($result->result_array() as $row) {
                # code...
                $return[$row['contract_statusid']] = $row['status_name'];
            }
        }

        return $return;

    }

    /*
     *  Dropdown list nama propinsi
     */
    function province_list()
    {
    	$this->db->from('ref_provinces');
        $this->db->order_by('id','asc');
    	$result = $this->db->get();

        $return = array();
        $return[0] = '-- Pilih Propinsi --';

        if ($result->num_rows() > 0) 
        {
            foreach ($result->result_array() as $row) {
                $return[$row['id']] = $row['name'];
            }
        }

        return $return;    	
    }

    /*
     *  Dropdown list nama kabupaten (dependensi province_id
     *  dari province_list)
     */
    function regency_list($province_id)
    {
    	$this->db->from('ref_regencies');
    	$this->db->where('province_id = '. $province_id);
        $this->db->order_by('name','asc');
    	$result = $this->db->get();

        $return = array();

        if ($result->num_rows() > 0) 
        {
            $return[0] = '-- Pilih Kabupaten --';
            foreach ($result->result_array() as $row) {
                $return[$row['id']] = $row['name'];
            }
        } else {
            $return[0] = '-- Pilih Kabupaten --';
        }

        return $return;    	
    }

     /*
     *  Dropdown list nama kecamatan (dependensi regency_id
     *  dari regency_list)
     */
    function district_list($regency_id)
    {
    	$this->db->from('ref_districts');
    	$this->db->where('regency_id',$regency_id);
        $this->db->order_by('name','asc');
    	$result = $this->db->get();

        $return = array();

        if ($result->num_rows() > 0) 
        {
            $return[0] = '-- Pilih Kecamatan --';
            foreach ($result->result_array() as $row) {
                $return[$row['id']] = $row['name'];
            }
        } else {
            $return[0] = '-- Pilih Kecamatan --';
        }

        return $return;    	
    }  

    /*
     *  Dropdown list nama kelurahan (dependensi district_id
     *  dari district_list)
     */
    function village_list($district_id)
    {
    	$this->db->from('ref_villages');
    	$this->db->where('district_id',$district_id);
        $this->db->order_by('name','asc');
    	$result = $this->db->get();

        $return = array();

        if ($result->num_rows() > 0) 
        {
            $return[0] = '-- Pilih Kelurahan --';
            foreach ($result->result_array() as $row) {
                $return[$row['id']] = $row['name'];
            }
        } else {
            $return[0] = '-- Pilih Kelurahan --';
        }

        return $return;    	
    }   

    function province_name($province_id)
    {
        $this->db->select('name');
        $this->db->from('ref_provinces');
        $this->db->where('id = '. $province_id);

        $result = $this->db->get();

        $row = $result->row();

        return $row->name;
    }

    function regency_name($regency_id)
    {
        $this->db->select('name');
        $this->db->from('ref_regencies');
        $this->db->where('id = '. $regency_id);

        $result = $this->db->get();

        $row = $result->row();

        return $row->name;
    }

    function district_name($district_id)
    {
        $this->db->select('name');
        $this->db->from('ref_districts');
        $this->db->where('id = '. $district_id);

        $result = $this->db->get();

        $row = $result->row();

        return $row->name;
    }

    function village_name($village_id)
    {
        $this->db->select('name');
        $this->db->from('ref_villages');
        $this->db->where('id = '. $village_id);

        $result = $this->db->get();

        $row = $result->row();

        return $row->name;
    }

    /*
     *  Dropdown list Aktif / Tidak Aktif
     *  untuk status data
     */
    function status_list()
    {
        $this->db->from('ref_status');
        $this->db->order_by('id','asc');
        $result = $this->db->get();

        $return = array('');

        if ($result->num_rows() > 0)
        {
            $return[0] = '-- Pilih Status --';
            foreach ($result->result_array() as $row) {
                $return[$row['string_status']] = $row['string_status'];
            }
        } else {
            $return[0] = '-- Pilih Status --';
        }

        return $return;     
    }  

    /*
     *  Dropdown list Jenis Kelamin
     */
    function gender_list()
    {
        $this->db->from('ref_genders');
        $this->db->order_by('id','asc');
        $result = $this->db->get();

        $return = array('');

        if ($result->num_rows() > 0)
        {
            $return[0] = '-- Pilih Gender --';
            foreach ($result->result_array() as $row) {
                $return[$row['id']] = $row['gender_name'];
            }
        } else {
            $return[0] = '-- Pilih Gender --';
        }

        return $return;     
    }  

    /*
     *  Dropdown list Tipe Darah
     */
    function blood_list()
    {
        $this->db->from('ref_bloodtypes');
        $this->db->order_by('id','asc');
        $result = $this->db->get();

        $return = array('');

        if ($result->num_rows() > 0)
        {
            $return[0] = '-- Pilih Gol. Darah --';
            foreach ($result->result_array() as $row) {
                $return[$row['id']] = $row['blood_type'];
            }
        } else {
            $return[0] = '-- Pilih Gol. Darah --';
        }

        return $return;     
    }  

    /*
     * Function untuk merubah tampilan angka dalam satuan Rp.
    */

    function rupiah($angka)
    {
        $hasil_rupiah = 'Rp ' . number_format($angka,0,',','.');

        return $hasil_rupiah;
    }

    function youtube_id($url)
    {
        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) 
        {
                $video_id = $match[1];
        }

        $html = '<div class="resp-container">
                    <iframe class="resp-iframe" src="https://www.youtube.com/embed/'.$video_id.'?autoplay=1" frameborder="0"></iframe>
                </div>';

        return $html;
    }

    /*
     * Drop down list nama Gembala
    */
    function pastor_list()
    {
        // $this->db->where('status_data','2');
        $this->db->from('pastors');
        $this->db->where('status_data','Aktif');
        $this->db->order_by('id','asc');
        $result = $this->db->get();

        $return = array('');

        if ($result->num_rows() > 0)
        {
            $return[0] = '-- Pilih Nama Gembala --';
            foreach ($result->result_array() as $row) {
                $return[$row['remarks']] = $row['remarks'];
            }
        } else {
            $return[0] = '-- Pilih Nama Gembala --';
        }

        return $return; 
    }

    /*
     * Drop down list nama-nama Individu yang berumur diatas 12 tahun
    */
    function individu_list()
    {
        // $this->db->where('status_data','2');
        $this->db->from('individuals');
        $this->db->where('status_data','Aktif');
        $this->db->where(' YEAR(CURDATE()) - YEAR(birth_date) > 20');
        $this->db->order_by('full_name','asc');
        $result = $this->db->get();

        $return = array('');

        if ($result->num_rows() > 0)
        {
            $return[0] = '-- Pilih Nama Kepala Keluarga --';
            foreach ($result->result_array() as $row) {
                $return[$row['id']] = $row['full_name'];
            }
        } else {
            $return[0] = '-- Pilih Nama Kepala Keluarga --';
        }

        return $return; 
    }

    /*
     * Drop down list nama Jabatan di Gereja
    */
    function rank_list()
    {
        // $this->db->where('status_data','2');
        $this->db->from('ref_ranks');
        $this->db->order_by('id','asc');
        $result = $this->db->get();

        $return = array('');

        if ($result->num_rows() > 0)
        {
            $return[0] = '-- Pilih Nama Jabatan --';
            foreach ($result->result_array() as $row) {
                $return[$row['id']] = $row['rank_name'];
            }
        } else {
            $return[0] = '-- Pilih Nama Jabatan --';
        }

        return $return; 
    }

    /*
     *  Dropdown list status pernikahan
     */
    function marriage_status()
    {
        $this->db->from('ref_marriages');
        $this->db->order_by('id','asc');
        $result = $this->db->get();

        $return = array();
        $return[0] = '-- Pilih Status Pernikahan --';

        if ($result->num_rows() > 0) 
        {
            foreach ($result->result_array() as $row) {
                # code...
                $return[$row['id']] = $row['status_name'];
            }
        }
        return $return;
    }

    /*
    * Finance List
    */
    function accounting_list()
    {
        $this->db->from('ref_accountings');
        $this->db->order_by('id','asc');
        $result = $this->db->get();

        $return = array();
        $return[0] = '-- Pemasukkan / Pengeluaran --';

        if ($result->num_rows() >0)
        {
            foreach ($result->result_array() as $row) {
                # code...
                $return[$row['id']] = $row['reference_name'];
            }
        }
        return $return;
    }

    /*
    * Type of Accounting Transaction List
    */
    function payment_list()
    {
        $this->db->from('ref_others');
        $this->db->where('categories','Jenis Transaksi Pembayaran');
        $this->db->where('status_data','Aktif');
        $this->db->order_by('id','asc');
        $result = $this->db->get();

        $return = array();
        $return[0] = '-- Pilih Jenis Transaksi --';

        if ($result->num_rows() >0)
        {
            foreach ($result->result_array() as $row) {
                # code...
                $return[$row['id']] = $row['value'];
            }
        }
        return $return;
    }

    /*
     * Nama-nama jiwa berulang tahun di bulan ini
    */
    function bday_list()
    {
        $this->db->select("i.full_name,i.nick_name,date_format(i.birth_date,'%d') 'tgl_ulangtahun', YEAR(CURDATE()) - YEAR(i.birth_date) 'umur',
            case DAYOFWEEK(DATE_FORMAT(i.birth_date,'2019-%m-%d'))
                WHEN 1 THEN 'Minggu'
                WHEN 2 THEN 'Senin'
                WHEN 3 THEN 'Selasa'
                WHEN 4 THEN 'Rabu'
                WHEN 5 THEN 'Kamis'
                WHEN 6 THEN 'Jumat'
                WHEN 7 THEN 'Sabtu'
            END AS 'day_name'");
        $this->db->from('individuals i');
        $this->db->where('i.status_data = "Aktif" and month(str_to_date(i.birth_date,"%Y-%m-%d")) = month(now())');
        $this->db->order_by("date_format(i.birth_date,'%d') ASC");
        $result = $this->db->get();

        return $result->result_array();
    }

    function today_bday()
    {
        $this->db->select("i.full_name,i.nick_name,date_format(i.birth_date,'%d') 'tgl_ulangtahun', YEAR(CURDATE()) - YEAR(i.birth_date) 'umur',
            case DAYOFWEEK(DATE_FORMAT(i.birth_date,'2019-%m-%d'))
                WHEN 1 THEN 'Minggu'
                WHEN 2 THEN 'Senin'
                WHEN 3 THEN 'Selasa'
                WHEN 4 THEN 'Rabu'
                WHEN 5 THEN 'Kamis'
                WHEN 6 THEN 'Jumat'
                WHEN 7 THEN 'Sabtu'
            END AS 'day_name'");
        $this->db->from('individuals i');
        $this->db->where('i.status_data = "Aktif" and DATE_FORMAT(i.birth_date,"2019-%m-%d") = CURDATE()');
        $this->db->order_by("date_format(i.birth_date,'%d') ASC");
        $result = $this->db->get();

        return $result->result_array();        
    }

    /*
     * Firman Tuhan
    */
    function scripture_text()
    {
        $this->db->select("CONCAT(s.scriptures_text,' (',s.scripture_section,')') as scripture_str, s.scriptures_text, s.scripture_section");
        $this->db->from('scriptures s');
        $this->db->where('date(NOW()) between s.start_date AND s.end_date');

        $result = $this->db->get();

        $row = $result->row_array();

        // return $row->scripture_str;
        return $row;
    }

    /*
     * Referensi Daftar Aktifitas
    */
    function activity_list()
    {
        $this->db->from('ref_activities');
        $this->db->where('status_data','Aktif');
        $this->db->order_by('id','asc');
        $result = $this->db->get();

        $return = array('');

        if ($result->num_rows() > 0)
        {
            $return[0] = '-- Pilih Nama Kegiatan --';
            foreach ($result->result_array() as $row) {
                $return[$row['id']] = $row['activity_name'];
            }
        } else {
            $return[0] = '-- Pilih Nama Kegiatan --';
        }

        return $return; 
    }

    /* Jadwal Kegiatan */
    function schedule_list($site_info)
    {
        $this->db->select(' a.id, a.ref_activityid, b.activity_name, 

            date_format(a.activity_date,"%d") today_date,
            date_format(a.activity_date,"%d %M %Y") tgl,
            case DAYOFWEEK(a.activity_date)
                WHEN 1 THEN "Minggu"
                WHEN 2 THEN "Senin"
                WHEN 3 THEN "Selasa"
                WHEN 4 THEN "Rabu"
                WHEN 5 THEN "Kamis"
                WHEN 6 THEN "Jumat"
                WHEN 7 THEN "Sabtu"
            END AS "day_name",
            time_format(a.time_start,"%H:%i") jam_mulai,
            time_format(a.time_end,"%H:%i") jam_selesai,
            date_format(a.activity_date,"%d") ddt,
            date_format(a.activity_date,"%b") as mot,
            a.remarks');
        $this->db->from('activities a');
        $this->db->join('ref_activities b','b.id = a.ref_activityid','left');
        $this->db->where('a.status_data = "Aktif"');
        if ($site_info === 'nologin') {
            $this->db->where('YEARWEEK(a.activity_date, 1) = YEARWEEK(CURDATE(), 1)');
            $this->db->where('a.activity_date >= CURDATE()');
        } // elseif ($site_info === 'login') {
        //     $this->db->where('MONTH(a.activity_date) = MONTH(CURRENT_DATE())');
        // }
        
        $this->db->order_by("a.activity_date asc, a.ref_activityid asc");
        $result = $this->db->get();

        return $result->result_array();        
    }

    /* Nama hari dalam Bahasa */
    function nama_hari($date_info)
    {
        $day_name = date($date_info);

        switch ($day_name) {
            case 1:
                $nama_hari = 'Minggu';
                break;
            case 2:
                $nama_hari = 'Senin';
                break;
            case 3:
                $nama_hari = 'Selasa';
                break;
            case 4:
                $nama_hari = 'Rabu';
                break;
            case 5:
                $nama_hari = 'Kamis';
                break;
            case 6:
                $nama_hari = "Jum'at";
                break;
            case 7:
                $nama_hari = 'Sabtu';
                break;
        }
        return $nama_hari;

    }

}