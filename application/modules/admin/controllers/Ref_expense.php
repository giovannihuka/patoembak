<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_expense extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Ref_expense_model');
        $this->load->library('form_builder');
        $this->load->model('common_model','common_ref');        
	    $this->load->library('datatables');
    }

    private $script = array(
        'assets/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js',
        'assets/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js',
        'assets/dist/admin/ref_expense.js',
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
        $this->mPageTitle = 'Informasi Kategori Pengeluaran'; 
        $this->render('ref_expense/ref_expenses_list');
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
        //     echo $this->Ref_expense_model->json($contractid);
        // }
        // else
        // {
            echo $this->Ref_expense_model->json();
        // }

        /* ------------------------------------------------- */

    }

    public function read($id)
    {
        $form = $this->form_builder->create_form();

        $row = $this->Ref_expense_model->get_by_id($id);
            
            if ($row)
            {

                $data = array (

					'category_name' => $row->category_name,
					'status_data' => $row->status_data,

                );
            }

        $this->mViewData['ref_expense'] = $data;
        $this->mPageTitle = 'Kategori Pengeluaran';
        $this->mViewData['form'] = $form;
        $this->render('ref_expense/ref_expenses_read');
    }

    public function delete($id) 
    {
        $row = $this->Ref_expense_model->get_by_id($id);

        if ($row) {
            $this->Ref_expense_model->set_primary_key('id');
            $this->Ref_expense_model->delete($id);
            $this->Ref_expense_model->set_primary_key('id');
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/ref_expense'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/ref_expense'));
        }
    }


    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "ref_expenses.xls";
        $judul = "ref_expenses";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Category Name");
	xlsWriteLabel($tablehead, $kolomhead++, "Status Data");
	xlsWriteLabel($tablehead, $kolomhead++, "Create Userid");
	xlsWriteLabel($tablehead, $kolomhead++, "Update Userid");
	xlsWriteLabel($tablehead, $kolomhead++, "Create Time");
	xlsWriteLabel($tablehead, $kolomhead++, "Update Time");

	foreach ($this->Ref_expense_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->category_name);
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
        $this->add_stylesheet($this->select2_style,TRUE,'screen');

        $userid = $this->ion_auth->get_user_id();
        $username = $this->ion_auth->get_user_name();
        $contractid = $this->ion_auth->get_contract_id();
        $usergroup = $this->ion_auth->get_users_groups()->row()->name;
        
        if ($form->validate())
        {
			$category_name = $this->input->post('category_name');
			$status_data = $this->input->post('status_data');

    		$data = $this->Ref_expense_model->
        	insert(array
                (
					'category_name' => $category_name,
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

        $this->mViewData['ref_expense'] = $this->Ref_expense_model->get_all();
        $this->mPageTitle = 'Registrasi Kategori Pengeluaran';
        $this->mViewData['form'] = $form;
        $this->render('ref_expense/ref_expenses_form');
        
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
			$category_name = $this->input->post('category_name');
			$status_data = $this->input->post('status_data');

            $this->Ref_expense_model->set_primary_key('id');

            $data = $this->Ref_expense_model->
            update($id,
                array
                (
					'category_name' => $category_name,
					'status_data' => $status_data,
					'update_userid' => $userid,
					'update_time' => time(),
				)
    );

    $this->Ref_expense_model->set_primary_key('id');

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

    $row = $this->Ref_expense_model->get_by_id($id);

    if ($row)
    {

        $data = array (
					'category_name' => $row->category_name,
					'status_data' => $row->status_data,
					'button' => 'Update',
                );
            }

        }

        $this->mViewData['ref_expense'] = $data;
        $this->mViewData['status_list'] = $this->common_ref->status_list();
        $this->mPageTitle = 'Ubah Kategori Pengeluaran';
        $this->mViewData['form'] = $form;
        $this->render('ref_expense/ref_expenses_update');
        
	}


/* 
Please copy this section into ../application/modules/admin/config/form_validation.php

	'ref_expense/create' => array(
			array(
            	'field'		 => 'category_name',
            	'label'		 => 'Kategori',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'status_data',
            	'label'		 => 'Status Data',
            	'rules'		 => 'trim|required',
        	),
        ),


	'ref_expense/update' => array(
			array(
            	'field'		 => 'category_name',
            	'label'		 => 'Kategori',
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
/* End of file Ref_expense.php */
/* Location: ./application/controllers/Ref_expense.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Custom Codeigniter CRUD Generator 2019-11-08 14:57:05 */