<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Accounting_model');
        $this->load->library('form_builder');
        $this->load->model('common_model','common_ref');        
	    $this->load->library('datatables');
    }

    private $script = array(
        'assets/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js',
        'assets/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js',
        'assets/dist/admin/accounting.js',
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
        $this->mPageTitle = 'Informasi Jurnal Keuangan'; 
        $this->render('accounting/accountings_list');
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
        //     echo $this->Accounting_model->json($contractid);
        // }
        // else
        // {
            echo $this->Accounting_model->json();
        // }

        /* ------------------------------------------------- */

    }

    public function read($id)
    {
        $form = $this->form_builder->create_form();

        $row = $this->Accounting_model->get_by_id($id);
            
            if ($row)
            {

                $data = array (

					'in_out' => $row->in_out,
					'activity_id' => $row->activity_id,
					'activity_date' => $row->activity_date,
					'amount' => $row->amount,
					'people' => $row->people,
					'description' => $row->description,
					'status_data' => $row->status_data,

                );
            }

        $this->mViewData['accounting'] = $data;
        $this->mPageTitle = 'Jurnal Keuangan';
        $this->mViewData['form'] = $form;
        $this->render('accounting/accountings_read');
    }

    public function delete($id) 
    {
        $row = $this->Accounting_model->get_by_id($id);

        if ($row) {
            $this->Accounting_model->set_primary_key('id');
            $this->Accounting_model->delete($id);
            $this->Accounting_model->set_primary_key('id');
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/accounting'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/accounting'));
        }
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
			$in_out = $this->input->post('in_out');
			$activity_id = $this->input->post('activity_id');
			$activity_date = $this->input->post('activity_date');
			$amount = $this->input->post('amount');
			$people = $this->input->post('people');
			$description = $this->input->post('description');
			$status_data = $this->input->post('status_data');

    		$data = $this->Accounting_model->
        	insert(array
                (
					'in_out' => $in_out,
					'activity_id' => $activity_id,
					'activity_date' => $activity_date,
					'amount' => $amount,
					'people' => $people,
					'description' => $description,
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

        $this->mViewData['accounting'] = $this->Accounting_model->get_all();
        $this->mViewData['in_out'] = $this->common_ref->accounting_list();
        $this->mViewData['activity_list'] = $this->common_ref->activity_list();
        $this->mViewData['status_list'] = $this->common_ref->status_list();
        $this->mPageTitle = 'Registrasi Jurnal Keuangan';
        $this->mViewData['form'] = $form;
        $this->render('accounting/accountings_form');
        
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
			$in_out = $this->input->post('in_out');
			$activity_id = $this->input->post('activity_id');
			$activity_date = $this->input->post('activity_date');
			$amount = $this->input->post('amount');
			$people = $this->input->post('people');
			$description = $this->input->post('description');
			$status_data = $this->input->post('status_data');

            $this->Accounting_model->set_primary_key('id');

            $data = $this->Accounting_model->
            update($id,
                array
                (
					'in_out' => $in_out,
					'activity_id' => $activity_id,
					'activity_date' => $activity_date,
					'amount' => $amount,
					'people' => $people,
					'description' => $description,
					'status_data' => $status_data,
					'update_userid' => $userid,
					'update_time' => time(),
				)
    );

    $this->Accounting_model->set_primary_key('id');

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

    $row = $this->Accounting_model->get_by_id($id);

    if ($row)
    {

        $data = array (
					'in_out' => $row->in_out,
					'activity_id' => $row->activity_id,
					'activity_date' => $row->activity_date,
					'amount' => $row->amount,
					'people' => $row->people,
					'description' => $row->description,
					'status_data' => $row->status_data,
					'button' => 'Update',
                );
            }

        }

        $this->mViewData['accounting'] = $data;
        // $this->mViewData['accounting'] = $this->Accounting_model->get_all();
        $this->mViewData['in_out_list'] = $this->common_ref->accounting_list();
        $this->mViewData['activity_list'] = $this->common_ref->activity_list();
        $this->mViewData['status_list'] = $this->common_ref->status_list();
        $this->mPageTitle = 'Ubah Jurnal Keuangan';
        $this->mViewData['form'] = $form;
        $this->render('accounting/accountings_update');
        
	}


/* 
Please copy this section into ../application/modules/admin/config/form_validation.php

	'accounting/create' => array(
			array(
            	'field'		 => 'in_out',
            	'label'		 => 'Pemasukan / Pengeluaran',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'activity_id',
            	'label'		 => 'Nama Aktifitas',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'activity_date',
            	'label'		 => 'Tanggal Aktifitas',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'amount',
            	'label'		 => 'Jumlah Uang',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'people',
            	'label'		 => 'Jemaat',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'description',
            	'label'		 => 'Keterangan',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'status_data',
            	'label'		 => 'Status Data',
            	'rules'		 => 'trim|required',
        	),
        ),


	'accounting/update' => array(
			array(
            	'field'		 => 'in_out',
            	'label'		 => 'Pemasukan / Pengeluaran',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'activity_id',
            	'label'		 => 'Nama Aktifitas',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'activity_date',
            	'label'		 => 'Tanggal Aktifitas',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'amount',
            	'label'		 => 'Jumlah Uang',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'people',
            	'label'		 => 'Jemaat',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'description',
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
/* End of file Accounting.php */
/* Location: ./application/controllers/Accounting.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Custom Codeigniter CRUD Generator 2020-02-11 22:02:32 */