<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_rank extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Ref_rank_model');
        $this->load->library('form_builder');
        $this->load->model('common_model','common_ref');        
	    $this->load->library('datatables');
    }

    private $script = array(
        'assets/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js',
        'assets/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js',
        'assets/dist/admin/ref_rank.js',
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
        $this->mPageTitle = 'Referensi Jabatan Gereja'; 
        $this->render('ref_rank/ref_ranks_list');
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
        //     echo $this->Ref_rank_model->json($contractid);
        // }
        // else
        // {
            echo $this->Ref_rank_model->json();
        // }

        /* ------------------------------------------------- */

    }

    public function read($id)
    {
        $form = $this->form_builder->create_form();

        $row = $this->Ref_rank_model->get_by_id($id);
            
            if ($row)
            {

                $data = array (

					'rank_name' => $row->rank_name,
					'status_data' => $row->status_data,

                );
            }

        $this->mViewData['ref_rank'] = $data;
        $this->mPageTitle = 'Referensi Jabatan Gereja';
        $this->mViewData['form'] = $form;
        $this->render('ref_rank/ref_ranks_read');
    }

    public function delete($id) 
    {
        $row = $this->Ref_rank_model->get_by_id($id);

        if ($row) {
            $this->Ref_rank_model->set_primary_key('id');
            $this->Ref_rank_model->delete($id);
            $this->Ref_rank_model->set_primary_key('id');
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/ref_rank'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/ref_rank'));
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
        
        if ($form->validate())
        {
			$rank_name = $this->input->post('rank_name');

    		$data = $this->Ref_rank_model->
        	insert(array
                (
					'rank_name' => $rank_name,
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

        $this->mViewData['ref_rank'] = $this->Ref_rank_model->get_all();
        $this->mViewData['status_list'] = $this->common_ref->status_list();
        $this->mPageTitle = 'Referensi Jabatan Gereja';
        $this->mViewData['form'] = $form;
        $this->render('ref_rank/ref_ranks_form');
        
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

        if ($form->validate())
        {
			$rank_name = $this->input->post('rank_name');
			$status_data = $this->input->post('status_data');

            $this->Ref_rank_model->set_primary_key('id');

            $data = $this->Ref_rank_model->
            update($id,
                array
                (
					'rank_name' => $rank_name,
					'status_data' => $status_data,
					'update_userid' => $userid,
					'update_time' => time(),
				)
    );

    $this->Ref_rank_model->set_primary_key('id');

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

    $row = $this->Ref_rank_model->get_by_id($id);

    if ($row)
    {

        $data = array (
					'rank_name' => $row->rank_name,
					'status_data' => $row->status_data,
					'button' => 'Update',
                );
            }

        }

        $this->mViewData['ref_rank'] = $data;
        $this->mViewData['status_list'] = $this->common_ref->status_list();
        $this->mPageTitle = 'Ubah Jabatan Gereja';
        $this->mViewData['form'] = $form;
        $this->render('ref_rank/ref_ranks_update');
        
	}


/* 
Please copy this section into ../application/modules/admin/config/form_validation.php

	'ref_rank/create' => array(
			array(
            	'field'		 => 'rank_name',
            	'label'		 => 'Nama Jabatan',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'status_data',
            	'label'		 => 'Status Data',
            	'rules'		 => 'trim|required',
        	),
        ),


	'ref_rank/update' => array(
			array(
            	'field'		 => 'rank_name',
            	'label'		 => 'Nama Jabatan',
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
/* End of file Ref_rank.php */
/* Location: ./application/controllers/Ref_rank.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Custom Codeigniter CRUD Generator 2018-08-03 14:52:00 */