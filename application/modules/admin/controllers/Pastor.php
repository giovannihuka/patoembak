<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pastor extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pastor_model');
        $this->load->library('form_builder');
        $this->load->model('common_model','common_ref');        
	    $this->load->library('datatables');
    }

    private $script = array(
        'assets/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js',
        'assets/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js',
        'assets/dist/admin/pastor.js',
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
        $this->mPageTitle = 'Informasi Data Gembala'; 
        $this->render('pastor/pastors_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');

        $userid = $this->ion_auth->get_user_id();
        $username = $this->ion_auth->get_user_name();
        $contractid = $this->ion_auth->get_contract_id();
        $usergroup = $this->ion_auth->get_users_groups($userid)->row()->name;

        /*
        * If need to filterize data on the list
        * remove comments below
        */

        // if ($contractid !== '1')
        // {
        //     echo $this->Pastor_model->json($contractid);
        // }
        // else
        // {
            echo $this->Pastor_model->json($usergroup);
        // }

        /* ------------------------------------------------- */

    }

    public function read($id)
    {
        $form = $this->form_builder->create_form();

        $row = $this->Pastor_model->get_by_id($id);
            
            if ($row)
            {

                $data = array (

					'remarks' => $row->remarks,
                    'rank_id' => $row->rank_id,
					'status_data' => $row->status_data,

                );
            }

        $this->mViewData['pastor'] = $data;
        $this->mViewData['rank_list'] = $this->common_ref->rank_list();
        $this->mPageTitle = 'Data Gembala';
        $this->mViewData['form'] = $form;
        $this->render('pastor/pastors_read');
    }

    public function delete($id) 
    {
        $row = $this->Pastor_model->get_by_id($id);

        if ($row) {
            $this->Pastor_model->set_primary_key('id');
            $this->Pastor_model->delete($id);
            $this->Pastor_model->set_primary_key('id');
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/pastor'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/pastor'));
        }
    }

    public function create()
    {
        $form = $this->form_builder->create_form('',false,array('autocomplete'=>'off'));

        // $this->add_script($this->datepicker_script,FALSE,'foot');
        // $this->add_script($this->phoneformat_script,FALSE,'foot');
        // $this->add_stylesheet($this->stylesheet,FALSE,'screen');

        $this->add_script($this->select2_script,FALSE,'foot');
        $this->add_script($this->datepicker_script,FALSE,'foot');
        $this->add_script($this->phoneformat_script,FALSE,'foot');
        
        $this->add_stylesheet($this->stylesheet,FALSE,'screen');
        $this->add_stylesheet($this->select2_style,TRUE,'screen');
        
        $userid = $this->ion_auth->get_user_id();
        $username = $this->ion_auth->get_user_name();
        $contractid = $this->ion_auth->get_contract_id();
        $usergroup = $this->ion_auth->get_users_groups($userid)->row()->name;
        
        if ($form->validate())
        {
			$remarks = $this->input->post('remarks');
			$rank_id = $this->input->post('rank_id');

    		$data = $this->Pastor_model->
        	insert(array
                (
					'remarks' => $remarks,
                    'rank_id' => $rank_id,
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

        $this->mViewData['pastor'] = $this->Pastor_model->get_all();
        $this->mViewData['status_list'] = $this->common_ref->status_list();
        $this->mViewData['rank_list'] = $this->common_ref->rank_list();
        $this->mPageTitle = 'Registrasi Data Gembala';
        $this->mViewData['form'] = $form;
        $this->render('pastor/pastors_form');
        
	}


    public function update($id)
    {
        $form = $this->form_builder->create_form('',false,array('autocomplete'=>'off'));

        // $this->add_script($this->datepicker_script,FALSE,'foot');
        // $this->add_script($this->phoneformat_script,FALSE,'foot');
        // $this->add_stylesheet($this->stylesheet,FALSE,'screen');

        $this->add_script($this->select2_script,FALSE,'foot');
        $this->add_script($this->datepicker_script,FALSE,'foot');
        $this->add_script($this->phoneformat_script,FALSE,'foot');
        
        $this->add_stylesheet($this->stylesheet,FALSE,'screen');
        $this->add_stylesheet($this->select2_style,TRUE,'screen');

        $userid = $this->ion_auth->get_user_id();
        $username = $this->ion_auth->get_user_name();
        $contractid = $this->ion_auth->get_contract_id();

        if ($form->validate())
        {
			$remarks = $this->input->post('remarks');
            $rank_id = $this->input->post('rank_id');
			$status_data = $this->input->post('status_data');

            $this->Pastor_model->set_primary_key('id');

            $data = $this->Pastor_model->
            update($id,
                array
                (
					'remarks' => $remarks,
                    'rank_id' => $rank_id,
					'status_data' => $status_data,
					'update_userid' => $userid,
					'update_time' => time(),
				)
    );

    $this->Pastor_model->set_primary_key('id');

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

    $row = $this->Pastor_model->get_by_id($id);

    if ($row)
    {

        $data = array (
					'remarks' => $row->remarks,
                    'rank_id' => $row->rank_id,
					'status_data' => $row->status_data,
					'button' => 'Update',
                );
            }

        }

        $this->mViewData['pastor'] = $data;
        $this->mViewData['status_list'] = $this->common_ref->status_list();
        $this->mViewData['rank_list'] = $this->common_ref->rank_list();
        $this->mPageTitle = 'Ubah Data Gembala';
        $this->mViewData['form'] = $form;
        $this->render('pastor/pastors_update');
        
	}


/* 
Please copy this section into ../application/modules/admin/config/form_validation.php

	'pastor/create' => array(
			array(
            	'field'		 => 'remarks',
            	'label'		 => 'Nama Gembala',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'status_data',
            	'label'		 => 'Status Data',
            	'rules'		 => 'trim|required',
        	),
        ),


	'pastor/update' => array(
			array(
            	'field'		 => 'remarks',
            	'label'		 => 'Nama Gembala',
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
/* End of file Pastor.php */
/* Location: ./application/controllers/Pastor.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Custom Codeigniter CRUD Generator 2018-08-03 11:12:40 */