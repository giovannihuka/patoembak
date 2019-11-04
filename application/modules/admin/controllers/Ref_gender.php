<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_gender extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Ref_gender_model');
        $this->load->library('form_builder');
        $this->load->model('common_model','common_ref');        
	    $this->load->library('datatables');
    }

    private $script = array(
        'assets/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js',
        'assets/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js',
        'assets/dist/admin/ref_gender.js',
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
        $this->mPageTitle = 'Referensi Gender'; 
        $this->render('ref_gender/ref_genders_list');
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
        //     echo $this->Ref_gender_model->json($contractid);
        // }
        // else
        // {
            echo $this->Ref_gender_model->json();
        // }

        /* ------------------------------------------------- */

    }

    public function read($id)
    {
        $form = $this->form_builder->create_form();

        $row = $this->Ref_gender_model->get_by_id($id);
            
            if ($row)
            {

                $data = array (

					'gender_name' => $row->gender_name,
					'status_data' => $row->status_data,

                );
            }

        $this->mViewData['ref_gender'] = $data;
        $this->mPageTitle = 'Referensi Gender';
        $this->mViewData['form'] = $form;
        $this->render('ref_gender/ref_genders_read');
    }

    public function delete($id) 
    {
        $row = $this->Ref_gender_model->get_by_id($id);

        if ($row) {
            $this->Ref_gender_model->set_primary_key('id');
            $this->Ref_gender_model->delete($id);
            $this->Ref_gender_model->set_primary_key('id');
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/ref_gender'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/ref_gender'));
        }
    }

    public function create()
    {
        $form = $this->form_builder->create_form('',false,array('autocomplete'=>'off'));

        $this->add_script($this->datepicker_script,FALSE,'foot');
        $this->add_script($this->phoneformat_script,FALSE,'foot');
        $this->add_stylesheet($this->stylesheet,FALSE,'screen');

        $userid = $this->ion_auth->get_user_id();
        $username = $this->ion_auth->get_user_name();
        $contractid = $this->ion_auth->get_contract_id();
        $usergroup = $this->ion_auth->get_users_groups()->row()->name;
        
        if ($form->validate())
        {
			$gender_name = $this->input->post('gender_name');
			$status_data = $this->input->post('status_data');

    		$data = $this->Ref_gender_model->
        	insert(array
                (
					'gender_name' => $gender_name,
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

        $this->mViewData['ref_gender'] = $this->Ref_gender_model->get_all();
        $this->mViewData['gender_list'] = $this->common_ref->gender_list();
        $this->mPageTitle = 'Registrasi Referensi Gender';
        $this->mViewData['form'] = $form;
        $this->render('ref_gender/ref_genders_form');
        
	}


    public function update($id)
    {
        $form = $this->form_builder->create_form('',false,array('autocomplete'=>'off'));

        $this->add_script($this->datepicker_script,FALSE,'foot');
        $this->add_script($this->phoneformat_script,FALSE,'foot');
        $this->add_stylesheet($this->stylesheet,FALSE,'screen');

        $userid = $this->ion_auth->get_user_id();
        $username = $this->ion_auth->get_user_name();
        $contractid = $this->ion_auth->get_contract_id();
        $usergroup = $this->ion_auth->get_users_groups()->row()->name;

        if ($form->validate())
        {
			$gender_name = $this->input->post('gender_name');
			$status_data = $this->input->post('status_data');

            $this->Ref_gender_model->set_primary_key('id');

            $data = $this->Ref_gender_model->
            update($id,
                array
                (
					'gender_name' => $gender_name,
					'status_data' => $status_data,
					'update_userid' => $userid,
					'update_time' => time(),
				)
    );

    $this->Ref_gender_model->set_primary_key('id');

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

    $row = $this->Ref_gender_model->get_by_id($id);

    if ($row)
    {

        $data = array (
					'gender_name' => $row->gender_name,
					'status_data' => $row->status_data,
					'button' => 'Update',
                );
            }

        }

        $this->mViewData['ref_gender'] = $data;
        $this->mViewData['gender_list'] = $this->common_ref->gender_list();
        $this->mViewData['status_list'] = $this->common_ref->status_list();
        $this->mPageTitle = 'Ubah Referensi Gender';
        $this->mViewData['form'] = $form;
        $this->render('ref_gender/ref_genders_update');
        
	}


/* 
Please copy this section into ../application/modules/admin/config/form_validation.php

	'ref_gender/create' => array(
			array(
            	'field'		 => 'gender_name',
            	'label'		 => 'Jenis Kelamin',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'status_data',
            	'label'		 => 'Status Data',
            	'rules'		 => 'trim|required',
        	),
        ),


	'ref_gender/update' => array(
			array(
            	'field'		 => 'gender_name',
            	'label'		 => 'Jenis Kelamin',
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
/* End of file Ref_gender.php */
/* Location: ./application/controllers/Ref_gender.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Custom Codeigniter CRUD Generator 2018-09-25 14:06:49 */