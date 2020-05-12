<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Familie extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Familie_model');
        $this->load->library('form_builder');
        $this->load->model('common_model','common_ref');        
	    $this->load->library('datatables');
    }

    private $script = array(
        'assets/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js',
        'assets/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js',
        'assets/dist/admin/familie.js',
    ); 

    private $stylesheet = array(
        // 'assets/datatables/DataTables-1.10.16/css/jquery.dataTables.min.css',
        'assets/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css',
        'assets/jquery-ui-1.12.1.custom/jquery-ui.css',
    );

    private $datepicker_script = array(
        'assets/jquery-ui-1.12.1.custom/jquery-ui.js',
        'assets/dist/admin/date_picker.js',
    );

    private $select2_style = array(
        'assets/select2/select2.min.css',
    );

    private $select2_script = array(
        'assets/select2/select2.full.min.js',
        'assets/dist/admin/select2.js',
    );

    private $phoneformat_script = array(
        'assets/grocery_crud/js/jquery_plugins/jquery.maskedinput.js',
        'assets/dist/admin/phone_format.js',
    );

    private $location_script = array(
        'assets/dist/admin/geolocation_list.js',
    );

    private $glo_category_script = array(
        'assets/dist/admin/prod_categorization.js',
    );

    public function index()
    {
        $this->add_script($this->script,FALSE,'foot');
        $this->add_stylesheet($this->stylesheet,FALSE,'screen');
        $this->mPageTitle = 'Informasi Data Keluarga'; 
        $this->render('familie/families_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');

        /*
        * If need to filterize data on the list
        * remove comments below
        */
        
        // $userid = $this->ion_auth->get_user_id();
        // $username = $this->ion_auth->get_user_name();
        // $contractid = $this->ion_auth->get_contract_id();
        
        // if ($contractid !== '1')
        // {
        //     echo $this->Familie_model->json($contractid);
        // }
        // else
        // {
            echo $this->Familie_model->json();
        // }

        /* ------------------------------------------------- */

    }

    public function read($id)
    {
        $form = $this->form_builder->create_form();

        $row = $this->Familie_model->get_by_id($id);
            
            if ($row)
            {

                $data = array (

					'head_fam_id' => $row->head_fam_id,
					'family_name' => $row->family_name,
					'family_description' => $row->family_description,
					'home_address' => $row->home_address,
					'province_id' => $this->common_ref->province_name($row->province_id),
					'regency_id' => $this->common_ref->regency_name($row->regency_id),
					'district_id' => $this->common_ref->district_name($row->district_id),
					'village_id' => $this->common_ref->village_name($row->village_id),
					'status_data' => $row->status_data,

                );
            }

        $this->mViewData['familie'] = $data;

        $this->mPageTitle = 'Data Keluarga';
        $this->mViewData['form'] = $form;
        $this->render('familie/families_read');
    }

    public function delete($id) 
    {
        $row = $this->Familie_model->get_by_id($id);

        if ($row) {
            $this->Familie_model->set_primary_key('id');
            $this->Familie_model->delete($id);
            $this->Familie_model->set_primary_key('id');
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/familie'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/familie'));
        }
    }


    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "families.xls";
        $judul = "families";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Head Fam Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Family Name");
	xlsWriteLabel($tablehead, $kolomhead++, "Family Description");
	xlsWriteLabel($tablehead, $kolomhead++, "Home Address");
	xlsWriteLabel($tablehead, $kolomhead++, "Province Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Regency Id");
	xlsWriteLabel($tablehead, $kolomhead++, "District Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Village Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Status Data");
	xlsWriteLabel($tablehead, $kolomhead++, "Create Userid");
	xlsWriteLabel($tablehead, $kolomhead++, "Update Userid");
	xlsWriteLabel($tablehead, $kolomhead++, "Create Time");
	xlsWriteLabel($tablehead, $kolomhead++, "Update Time");

	foreach ($this->Familie_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->head_fam_id);
	    xlsWriteLabel($tablebody, $kolombody++, $data->family_name);
	    xlsWriteLabel($tablebody, $kolombody++, $data->family_description);
	    xlsWriteLabel($tablebody, $kolombody++, $data->home_address);
	    xlsWriteNumber($tablebody, $kolombody++, $data->province_id);
	    xlsWriteNumber($tablebody, $kolombody++, $data->regency_id);
	    xlsWriteNumber($tablebody, $kolombody++, $data->district_id);
	    xlsWriteNumber($tablebody, $kolombody++, $data->village_id);
	    xlsWriteLabel($tablebody, $kolombody++, $data->status_data);
	    xlsWriteNumber($tablebody, $kolombody++, $data->create_userid);
	    xlsWriteNumber($tablebody, $kolombody++, $data->update_userid);
	    xlsWriteNumber($tablebody, $kolombody++, $data->create_time);
	    xlsWriteNumber($tablebody, $kolombody++, $data->update_time);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function get_regencylist()
    {
        $province_id = $this->input->post('province_id');
        if ($province_id) {
            $result = $this->common_ref->regency_list($province_id);
        } else {
            $result = $this->common_ref->regency_list('0');
        }
        $retval = $this->form_builder->create_form()->bs3_dropdown('Kabupaten','ref_regencies',$result); 
        echo $retval;
        //echo json_encode($result);
    }

    public function get_districtlist()
    {
        $regency_id = $this->input->post('regency_id');
        if ($regency_id) {
            $result = $this->common_ref->district_list($regency_id);       
        } else {
            $result = $this->common_ref->district_list('0');       
        }
        $retval = $this->form_builder->create_form()->bs3_dropdown('Kecamatan','ref_districts',$result); 
        echo $retval;
        //echo json_encode($result);
    }

    public function get_villagelist()
    {
        $district_id = $this->input->post('district_id');
        if ($district_id) {
            $result = $this->common_ref->village_list($district_id);
        } else {
            $result = $this->common_ref->village_list('0');
        }
        $retval = $this->form_builder->create_form()->bs3_dropdown('Kelurahan','ref_villages',$result); 
        echo $retval;
        //echo json_encode($result);
    }


    public function create()
    {
        $form = $this->form_builder->create_form('',false,array('autocomplete'=>'off'));

        $this->add_script($this->select2_script,FALSE,'foot');
        $this->add_script($this->datepicker_script,FALSE,'foot');
        $this->add_script($this->phoneformat_script,FALSE,'foot');
        $this->add_stylesheet($this->stylesheet,FALSE,'screen');
        $this->add_stylesheet($this->select2_style,TRUE,'screen');

        $userid = $this->ion_auth->get_user_id();
        $username = $this->ion_auth->get_user_name();
        $contractid = $this->ion_auth->get_contract_id();
        $usergroup = $this->ion_auth->get_users_groups()->row()->name;
        
        if ($form->validate())
        {
			$head_fam_id = $this->input->post('head_fam_id');
			$family_name = $this->input->post('family_name');
			$family_description = $this->input->post('family_description');
			$home_address = $this->input->post('home_address');
			$province_id = $this->input->post('ref_provinceid');
			$regency_id = $this->input->post('ref_regencies');
			$district_id = $this->input->post('ref_districts');
			$village_id = $this->input->post('ref_villages');
			// $status_data = $this->input->post('status_data');

    		$data = $this->Familie_model->
        	insert(array
                (
					'head_fam_id' => $head_fam_id,
					'family_name' => $family_name,
					'family_description' => $family_description,
					'home_address' => $home_address,
					'province_id' => $province_id,
					'regency_id' => $regency_id,
					'district_id' => $district_id,
					'village_id' => $village_id,
					'status_data' => 'Aktif', // '1' = Data Baru; '2' = Aktif; '3' = Tidak Aktif
					'create_userid' => $userid,
					'update_userid' => $userid,
					'create_time' => time(),
					'update_time' => time(),
				)
            );

            if ($data)
            {
                $this->system_message->set_success('New data inserted successfully');
            }
            else
            {
                // $errors = $this->system_message->errors();
                $this->system_message->set_error($this->system_message->errors());
            }
            
            refresh();
        }

        $this->add_script($this->location_script,FALSE,'foot');
        $this->mViewData['familie'] = $this->Familie_model->get_all();
        $this->mViewData['individu_list'] = $this->common_ref->individunonfamily_list();
        $this->mViewData['province_list'] = $this->common_ref->province_list();
        $this->mViewData['regency_list'] = $this->common_ref->regency_list('');
        $this->mViewData['district_list'] = $this->common_ref->district_list('');
        $this->mViewData['village_list'] = $this->common_ref->village_list('');
        $this->mPageTitle = 'Registrasi Data Keluarga';
        $this->mViewData['form'] = $form;
        $this->render('familie/families_form');
        
	}


    public function update($id)
    {
        $form = $this->form_builder->create_form('',false,array('autocomplete'=>'off'));

        $this->add_script($this->select2_script,FALSE,'foot');
        $this->add_script($this->datepicker_script,FALSE,'foot');
        $this->add_script($this->phoneformat_script,FALSE,'foot');
        $this->add_stylesheet($this->stylesheet,FALSE,'screen');
        $this->add_stylesheet($this->select2_style,TRUE,'screen');

        $userid = $this->ion_auth->get_user_id();
        $username = $this->ion_auth->get_user_name();
        $contractid = $this->ion_auth->get_contract_id();
        $usergroup = $this->ion_auth->get_users_groups()->row()->name;

        if ($form->validate())
        {
			// $head_fam_id = $this->input->post('head_fam_id');
			$family_name = $this->input->post('family_name');
			$family_description = $this->input->post('family_description');
			$home_address = $this->input->post('home_address');
            $province_id = $this->input->post('ref_provinceid');
            $regency_id = $this->input->post('ref_regencies');
            $district_id = $this->input->post('ref_districts');
            $village_id = $this->input->post('ref_villages');
			$status_data = $this->input->post('status_data');

            $this->Familie_model->set_primary_key('id');

            $data = $this->Familie_model->
            update($id,
                array
                (
					// 'head_fam_id' => $head_fam_id,
					'family_name' => $family_name,
					'family_description' => $family_description,
					'home_address' => $home_address,
                    'province_id' => $province_id,
                    'regency_id' => $regency_id,
                    'district_id' => $district_id,
                    'village_id' => $village_id,
					'status_data' => $status_data,
					'update_userid' => $userid,
					'update_time' => time(),
				)
    );

    $this->Familie_model->set_primary_key('id');

    if ($data)
    {
        $this->system_message->set_success('Data updated successfully');
    }
    else
    {
        // $errors = $this->system_message->errors();
        $this->system_message->set_error($this->system_message->errors());
    }

    refresh();

    } else {

    $row = $this->Familie_model->get_by_id($id);

    if ($row)
    {

        $data = array (
					'head_fam_id' => $row->head_fam_id,
                    'family_head_full_name' => $row->full_name,
					'family_name' => $row->family_name,
					'family_description' => $row->family_description,
					'home_address' => $row->home_address,
					'province_id' => $row->province_id,
					'regency_id' => $row->regency_id,
					'district_id' => $row->district_id,
					'village_id' => $row->village_id,
					'status_data' => $row->status_data,
					'button' => 'Update',
                );
            }

        }

        $this->mViewData['province_list'] = $this->common_ref->province_list();
        $this->mViewData['regency_list'] = $this->common_ref->regency_list($row->province_id);
        $this->mViewData['district_list'] = $this->common_ref->district_list($row->regency_id);
        $this->mViewData['village_list'] = $this->common_ref->village_list($row->district_id);
        $this->mViewData['status_list'] = $this->common_ref->status_list();
        $this->mViewData['familie'] = $data;
        $this->mPageTitle = 'Ubah Data Keluarga';
        $this->mViewData['form'] = $form;
        $this->render('familie/families_update');
        
	}


/* 
Please copy this section into ../application/modules/admin/config/form_validation.php

	'familie/create' => array(
			array(
            	'field'		 => 'head_fam_id',
            	'label'		 => 'Kepala Keluarga',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'family_name',
            	'label'		 => 'Nama Keluarga',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'family_description',
            	'label'		 => 'Keterangan',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'home_address',
            	'label'		 => 'Alamat Rumah',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'province_id',
            	'label'		 => 'Propinsi',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'regency_id',
            	'label'		 => 'Kabupaten',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'district_id',
            	'label'		 => 'Kecamatan',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'village_id',
            	'label'		 => 'Kelurahan',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'status_data',
            	'label'		 => 'Status Data',
            	'rules'		 => 'trim|required',
        	),
        ),


	'familie/update' => array(
			array(
            	'field'		 => 'head_fam_id',
            	'label'		 => 'Kepala Keluarga',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'family_name',
            	'label'		 => 'Nama Keluarga',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'family_description',
            	'label'		 => 'Keterangan',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'home_address',
            	'label'		 => 'Alamat Rumah',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'province_id',
            	'label'		 => 'Propinsi',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'regency_id',
            	'label'		 => 'Kabupaten',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'district_id',
            	'label'		 => 'Kecamatan',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'village_id',
            	'label'		 => 'Kelurahan',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'status_data',
            	'label'		 => 'Status Data',
            	'rules'		 => 'trim|required',
        	),
        ),

*/

}
/* End of file Familie.php */
/* Location: ./application/controllers/Familie.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Custom Codeigniter CRUD Generator 2019-10-01 06:38:00 */