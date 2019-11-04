<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Relationship extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Relationship_model');
        $this->load->library('form_builder');
        $this->load->model('common_model','common_ref');        
	    $this->load->library('datatables');
    }

    private $script = array(
        'assets/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js',
        'assets/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js',
        'assets/dist/admin/relationship.js',
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
        $this->mPageTitle = 'Informasi Hubungan Keluarga'; 
        $this->render('relationship/relationships_list');
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
        //     echo $this->Relationship_model->json($contractid);
        // }
        // else
        // {
            echo $this->Relationship_model->json();
        // }

        /* ------------------------------------------------- */

    }

    public function read($id)
    {
        $form = $this->form_builder->create_form();

        $row = $this->Relationship_model->get_by_id($id);
            
            if ($row)
            {

                $data = array (

					'family_id' => $row->family_id,
					'individu_1_id' => $row->individu_1_id,
					'individu_2_id' => $row->individu_2_id,
					'relationship_type_id' => $row->relationship_type_id,
					'ind_1_role_id' => $row->ind_1_role_id,
					'ind_2_role_id' => $row->ind_2_role_id,
					'date_relationship_start' => $row->date_relationship_start,
					'date_relationship_end' => $row->date_relationship_end,
					'relationship_place' => $row->relationship_place,
					'remarks' => $row->remarks,
					'status_data' => $row->status_data,

                );
            }

        $this->mViewData['relationship'] = $data;
        $this->mPageTitle = 'Hubungan Keluarga';
        $this->mViewData['form'] = $form;
        $this->render('relationship/relationships_read');
    }

    public function delete($id) 
    {
        $row = $this->Relationship_model->get_by_id($id);

        if ($row) {
            $this->Relationship_model->set_primary_key('id');
            $this->Relationship_model->delete($id);
            $this->Relationship_model->set_primary_key('id');
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/relationship'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/relationship'));
        }
    }


    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "relationships.xls";
        $judul = "relationships";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Family Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Individu 1 Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Individu 2 Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Relationship Type Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Ind 1 Role Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Ind 2 Role Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Date Relationship Start");
	xlsWriteLabel($tablehead, $kolomhead++, "Date Relationship End");
	xlsWriteLabel($tablehead, $kolomhead++, "Relationship Place");
	xlsWriteLabel($tablehead, $kolomhead++, "Remarks");
	xlsWriteLabel($tablehead, $kolomhead++, "Status Data");
	xlsWriteLabel($tablehead, $kolomhead++, "Create Userid");
	xlsWriteLabel($tablehead, $kolomhead++, "Update Userid");
	xlsWriteLabel($tablehead, $kolomhead++, "Create Time");
	xlsWriteLabel($tablehead, $kolomhead++, "Update Time");

	foreach ($this->Relationship_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->family_id);
	    xlsWriteNumber($tablebody, $kolombody++, $data->individu_1_id);
	    xlsWriteNumber($tablebody, $kolombody++, $data->individu_2_id);
	    xlsWriteNumber($tablebody, $kolombody++, $data->relationship_type_id);
	    xlsWriteNumber($tablebody, $kolombody++, $data->ind_1_role_id);
	    xlsWriteNumber($tablebody, $kolombody++, $data->ind_2_role_id);
	    xlsWriteLabel($tablebody, $kolombody++, $data->date_relationship_start);
	    xlsWriteLabel($tablebody, $kolombody++, $data->date_relationship_end);
	    xlsWriteLabel($tablebody, $kolombody++, $data->relationship_place);
	    xlsWriteLabel($tablebody, $kolombody++, $data->remarks);
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
    public function create()
    {
        $form = $this->form_builder->create_form('',false,array('autocomplete'=>'off'));

        $this->add_script($this->select2_script,FALSE,'foot');
        $this->add_script($this->datepicker_script,FALSE,'foot');
        $this->add_script($this->phoneformat_script,FALSE,'foot');
        $this->add_stylesheet($this->stylesheet,FALSE,'screen');

        $userid = $this->ion_auth->get_user_id();
        $username = $this->ion_auth->get_user_name();
        $contractid = $this->ion_auth->get_contract_id();
        $usergroup = $this->ion_auth->get_users_groups()->row()->name;
        
        if ($form->validate())
        {
			$family_id = $this->input->post('family_id');
			$individu_1_id = $this->input->post('individu_1_id');
			$individu_2_id = $this->input->post('individu_2_id');
			$relationship_type_id = $this->input->post('relationship_type_id');
			$ind_1_role_id = $this->input->post('ind_1_role_id');
			$ind_2_role_id = $this->input->post('ind_2_role_id');
			$date_relationship_start = $this->input->post('date_relationship_start');
			$date_relationship_end = $this->input->post('date_relationship_end');
			$relationship_place = $this->input->post('relationship_place');
			$remarks = $this->input->post('remarks');
			$status_data = $this->input->post('status_data');

    		$data = $this->Relationship_model->
        	insert(array
                (
					'family_id' => $family_id,
					'individu_1_id' => $individu_1_id,
					'individu_2_id' => $individu_2_id,
					'relationship_type_id' => $relationship_type_id,
					'ind_1_role_id' => $ind_1_role_id,
					'ind_2_role_id' => $ind_2_role_id,
					'date_relationship_start' => $date_relationship_start,
					'date_relationship_end' => $date_relationship_end,
					'relationship_place' => $relationship_place,
					'remarks' => $remarks,
					'status_data' => $status_data, // '1' = Data Baru; '2' = Aktif; '3' = Tidak Aktif
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

        $this->mViewData['relationship'] = $this->Relationship_model->get_all();
        $this->mPageTitle = 'Registrasi Hubungan Keluarga';
        $this->mViewData['form'] = $form;
        $this->render('relationship/relationships_form');
        
	}


    public function update($id)
    {
        $form = $this->form_builder->create_form('',false,array('autocomplete'=>'off'));

        $this->add_script($this->select2_script,FALSE,'foot');
        $this->add_script($this->datepicker_script,FALSE,'foot');
        $this->add_script($this->phoneformat_script,FALSE,'foot');
        $this->add_stylesheet($this->stylesheet,FALSE,'screen');

        $userid = $this->ion_auth->get_user_id();
        $username = $this->ion_auth->get_user_name();
        $contractid = $this->ion_auth->get_contract_id();
        $usergroup = $this->ion_auth->get_users_groups()->row()->name;

        if ($form->validate())
        {
			$family_id = $this->input->post('family_id');
			$individu_1_id = $this->input->post('individu_1_id');
			$individu_2_id = $this->input->post('individu_2_id');
			$relationship_type_id = $this->input->post('relationship_type_id');
			$ind_1_role_id = $this->input->post('ind_1_role_id');
			$ind_2_role_id = $this->input->post('ind_2_role_id');
			$date_relationship_start = $this->input->post('date_relationship_start');
			$date_relationship_end = $this->input->post('date_relationship_end');
			$relationship_place = $this->input->post('relationship_place');
			$remarks = $this->input->post('remarks');
			$status_data = $this->input->post('status_data');

            $this->Relationship_model->set_primary_key('id');

            $data = $this->Relationship_model->
            update($id,
                array
                (
					'family_id' => $family_id,
					'individu_1_id' => $individu_1_id,
					'individu_2_id' => $individu_2_id,
					'relationship_type_id' => $relationship_type_id,
					'ind_1_role_id' => $ind_1_role_id,
					'ind_2_role_id' => $ind_2_role_id,
					'date_relationship_start' => $date_relationship_start,
					'date_relationship_end' => $date_relationship_end,
					'relationship_place' => $relationship_place,
					'remarks' => $remarks,
					'status_data' => $status_data,
					'update_userid' => $userid,
					'update_time' => time(),
				)
    );

    $this->Relationship_model->set_primary_key('id');

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

    $row = $this->Relationship_model->get_by_id($id);

    if ($row)
    {

        $data = array (
					'family_id' => $row->family_id,
					'individu_1_id' => $row->individu_1_id,
					'individu_2_id' => $row->individu_2_id,
					'relationship_type_id' => $row->relationship_type_id,
					'ind_1_role_id' => $row->ind_1_role_id,
					'ind_2_role_id' => $row->ind_2_role_id,
					'date_relationship_start' => $row->date_relationship_start,
					'date_relationship_end' => $row->date_relationship_end,
					'relationship_place' => $row->relationship_place,
					'remarks' => $row->remarks,
					'status_data' => $row->status_data,
					'button' => 'Update',
                );
            }

        }

        $this->mViewData['relationship'] = $data;
        $this->mPageTitle = 'Ubah Hubungan Keluarga';
        $this->mViewData['form'] = $form;
        $this->render('relationship/relationships_update');
        
	}


/* 
Please copy this section into ../application/modules/admin/config/form_validation.php

	'relationship/create' => array(
			array(
            	'field'		 => 'family_id',
            	'label'		 => 'ID Keluarga',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'individu_1_id',
            	'label'		 => 'Individu 1',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'individu_2_id',
            	'label'		 => 'Individu 2',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'relationship_type_id',
            	'label'		 => 'Hubungan Dalam Keluarga',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'ind_1_role_id',
            	'label'		 => 'Individu 1 Status',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'ind_2_role_id',
            	'label'		 => 'Individu 2 Status',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'date_relationship_start',
            	'label'		 => 'Tanggal Mulai Hubungan',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'date_relationship_end',
            	'label'		 => 'Tanggal Akhir Hubungan',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'relationship_place',
            	'label'		 => 'Kota',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'remarks',
            	'label'		 => 'Keterangan',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'status_data',
            	'label'		 => 'Status Data',
            	'rules'		 => 'trim|required',
        	),
        ),


	'relationship/update' => array(
			array(
            	'field'		 => 'family_id',
            	'label'		 => 'ID Keluarga',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'individu_1_id',
            	'label'		 => 'Individu 1',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'individu_2_id',
            	'label'		 => 'Individu 2',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'relationship_type_id',
            	'label'		 => 'Hubungan Dalam Keluarga',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'ind_1_role_id',
            	'label'		 => 'Individu 1 Status',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'ind_2_role_id',
            	'label'		 => 'Individu 2 Status',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'date_relationship_start',
            	'label'		 => 'Tanggal Mulai Hubungan',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'date_relationship_end',
            	'label'		 => 'Tanggal Akhir Hubungan',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'relationship_place',
            	'label'		 => 'Kota',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'remarks',
            	'label'		 => 'Keterangan',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'status_data',
            	'label'		 => 'Status Data',
            	'rules'		 => 'trim|required',
        	),
        ),

*/

}
/* End of file Relationship.php */
/* Location: ./application/controllers/Relationship.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Custom Codeigniter CRUD Generator 2019-10-04 05:24:55 */