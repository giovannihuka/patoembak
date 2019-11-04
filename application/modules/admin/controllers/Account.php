<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Account_model');
        $this->load->library('form_builder');
        $this->load->model('common_model','common_ref');        
	    $this->load->library('datatables');
    }

    private $script = array(
        'assets/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js',
        // 'assets/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js',
        'assets/dist/admin/account.js',
    ); 

    private $stylesheet = array(
        'assets/datatables/DataTables-1.10.16/css/jquery.dataTables.min.css',
        // 'assets/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css',
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
        $this->mPageTitle = 'Informasi CoA'; 
        $this->render('account/accounts_list');
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
        //     echo $this->Account_model->json($contractid);
        // }
        // else
        // {
            echo $this->Account_model->json();
        // }

        /* ------------------------------------------------- */

    }

    public function read($id)
    {
        $form = $this->form_builder->create_form();

        $row = $this->Account_model->get_by_id($id);
            
            if ($row)
            {

                $data = array (

					'parent_id' => $row->parent_id,
					'ref_charttype' => $row->ref_charttype,
					'level_num' => $row->level_num,
					'chart_name' => $row->chart_name,
					'status_data' => $row->status_data,

                );
            }

        $this->mViewData['account'] = $data;
        $this->mPageTitle = 'CoA';
        $this->mViewData['form'] = $form;
        $this->render('account/accounts_read');
    }

    public function delete($id) 
    {
        $row = $this->Account_model->get_by_id($id);

        if ($row) {
            $this->Account_model->set_primary_key('id');
            $this->Account_model->delete($id);
            $this->Account_model->set_primary_key('id');
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/account'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/account'));
        }
    }

    public function create()
    {
        $form = $this->form_builder->create_form('',false,array('autocomplete'=>'off'));

        $this->add_script($this->select2_script,FALSE,'foot');
        $this->add_script($this->datepicker_script,FALSE,'foot');
        $this->add_script($this->phoneformat_script,FALSE,'foot');
        $this->add_stylesheet($this->stylesheet,FALSE,'screen');
        $this->add_stylesheet($this->select2_style,FALSE,'screen');

        $userid = $this->ion_auth->get_user_id();
        $username = $this->ion_auth->get_user_name();
        $contractid = $this->ion_auth->get_contract_id();
        $usergroup = $this->ion_auth->get_users_groups()->row()->name;
        
        if ($form->validate())
        {
			$parent_id = $this->input->post('parent_id');
			$ref_charttype = $this->input->post('ref_charttype');
            $level_num = $this->Account_model->get_level_parent($parent_id);
            $chart_num = $this->input->post('chart_num');
			$chart_name = $this->input->post('chart_name');
			$status_data = $this->input->post('status_data');

    		$data = $this->Account_model->
        	insert(array
                (
					'parent_id' => $parent_id,
					'ref_charttype' => $ref_charttype,
					'level_num' => $level_num,
                    'chart_num' => $chart_num,
					'chart_name' => strtoupper($chart_name),
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

        $this->mViewData['account'] = $this->Account_model->get_all();
        $this->mPageTitle = 'Registrasi CoA';
        $this->mViewData['form'] = $form;
        $this->mViewData['type_chart_list'] = $this->Account_model->type_chart_list();
        $this->mViewData['account_list'] = $this->Account_model->account_list();
        $this->render('account/accounts_form');
        
	}


    public function update($id)
    {
        $form = $this->form_builder->create_form('',false,array('autocomplete'=>'off'));

        $this->add_script($this->select2_script,FALSE,'foot');
        $this->add_script($this->datepicker_script,FALSE,'foot');
        $this->add_script($this->phoneformat_script,FALSE,'foot');
        $this->add_stylesheet($this->stylesheet,FALSE,'screen');
        $this->add_stylesheet($this->select2_style,FALSE,'screen');

        $userid = $this->ion_auth->get_user_id();
        $username = $this->ion_auth->get_user_name();
        $contractid = $this->ion_auth->get_contract_id();
        $usergroup = $this->ion_auth->get_users_groups()->row()->name;

        if ($form->validate())
        {
			$parent_id = $this->input->post('parent_id');
			$ref_charttype = $this->input->post('ref_charttype');
            $level_num = $this->Account_model->get_level_parent($parent_id);
            $chart_num = $this->input->post('chart_num');
			$chart_name = $this->input->post('chart_name');
			$status_data = $this->input->post('status_data');

            $this->Account_model->set_primary_key('id');

            $data = $this->Account_model->
            update($id,
                array
                (
					'parent_id' => $parent_id,
					'ref_charttype' => $ref_charttype,
					'level_num' => $level_num,
                    'chart_num' => $chart_num,
					'chart_name' => $chart_name,
					'status_data' => $status_data,
					'update_userid' => $userid,
					'update_time' => time(),
				)
    );

    $this->Account_model->set_primary_key('id');

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

    $row = $this->Account_model->get_by_id($id);

    if ($row)
    {

        $data = array (
					'parent_id' => $row->parent_id,
					'ref_charttype' => $row->ref_charttype,
					'level_num' => $row->level_num,
                    'chart_num' => $row->chart_num,
					'chart_name' => $row->chart_name,
					'status_data' => $row->status_data,
					'button' => 'Update',
                );
            }

        }

        $this->mViewData['account'] = $data;
        $this->mPageTitle = 'Ubah CoA';
        $this->mViewData['form'] = $form;
        $this->mViewData['type_chart_list'] = $this->Account_model->type_chart_list();
        $this->mViewData['account_list'] = $this->Account_model->account_list();
        $this->mViewData['status_list'] = $this->common_ref->status_list();
        $this->render('account/accounts_update');
        
	}


/* 
Please copy this section into ../application/modules/admin/config/form_validation.php

	'account/create' => array(
			array(
            	'field'		 => 'parent_id',
            	'label'		 => 'Rekening Induk',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'ref_charttype',
            	'label'		 => 'Tipe Rekening',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'level_num',
            	'label'		 => 'Level',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'chart_name',
            	'label'		 => 'Nama Rekening',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'status_data',
            	'label'		 => 'Status Data',
            	'rules'		 => 'trim|required',
        	),
        ),


	'account/update' => array(
			array(
            	'field'		 => 'parent_id',
            	'label'		 => 'Rekening Induk',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'ref_charttype',
            	'label'		 => 'Tipe Rekening',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'level_num',
            	'label'		 => 'Level',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'chart_name',
            	'label'		 => 'Nama Rekening',
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
/* End of file Account.php */
/* Location: ./application/controllers/Account.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Custom Codeigniter CRUD Generator 2019-02-07 16:09:28 */