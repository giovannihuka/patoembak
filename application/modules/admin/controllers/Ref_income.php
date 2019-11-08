<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_income extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Ref_income_model');
        $this->load->library('form_builder');
        $this->load->model('common_model','common_ref');        
	    $this->load->library('datatables');
    }

    private $script = array(
        'assets/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js',
        'assets/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js',
        'assets/dist/admin/ref_income.js',
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
        $this->mPageTitle = 'Informasi Kategori Pemasukkan'; 
        $this->render('ref_income/ref_incomes_list');
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
        //     echo $this->Ref_income_model->json($contractid);
        // }
        // else
        // {
            echo $this->Ref_income_model->json();
        // }

        /* ------------------------------------------------- */

    }

    public function read($id)
    {
        $form = $this->form_builder->create_form();

        $row = $this->Ref_income_model->get_by_id($id);
            
            if ($row)
            {

                $data = array (

					'category_name' => $row->category_name,

                );
            }

        $this->mViewData['ref_income'] = $data;
        $this->mPageTitle = 'Kategori Pemasukkan';
        $this->mViewData['form'] = $form;
        $this->render('ref_income/ref_incomes_read');
    }

    public function delete($id) 
    {
        $row = $this->Ref_income_model->get_by_id($id);

        if ($row) {
            $this->Ref_income_model->set_primary_key('id');
            $this->Ref_income_model->delete($id);
            $this->Ref_income_model->set_primary_key('id');
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/ref_income'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/ref_income'));
        }
    }


    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "ref_incomes.xls";
        $judul = "ref_incomes";
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

	foreach ($this->Ref_income_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->category_name);

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

    		$data = $this->Ref_income_model->
        	insert(array
                (
					'category_name' => $category_name,
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

        $this->mViewData['ref_income'] = $this->Ref_income_model->get_all();
        $this->mPageTitle = 'Registrasi Kategori Pemasukkan';
        $this->mViewData['form'] = $form;
        $this->render('ref_income/ref_incomes_form');
        
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

            $this->Ref_income_model->set_primary_key('id');

            $data = $this->Ref_income_model->
            update($id,
                array
                (
					'category_name' => $category_name,
				)
    );

    $this->Ref_income_model->set_primary_key('id');

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

    $row = $this->Ref_income_model->get_by_id($id);

    if ($row)
    {

        $data = array (
					'category_name' => $row->category_name,
					'button' => 'Update',
                );
            }

        }

        $this->mViewData['ref_income'] = $data;
        $this->mViewData['status_list'] = $this->common_ref->status_list();
        $this->mPageTitle = 'Ubah Kategori Pemasukkan';
        $this->mViewData['form'] = $form;
        $this->render('ref_income/ref_incomes_update');
        
	}


/* 
Please copy this section into ../application/modules/admin/config/form_validation.php

	'ref_income/create' => array(
			array(
            	'field'		 => 'category_name',
            	'label'		 => 'Kategori',
            	'rules'		 => 'trim|required',
        	),
        ),


	'ref_income/update' => array(
			array(
            	'field'		 => 'category_name',
            	'label'		 => 'Kategori',
            	'rules'		 => 'trim|required',
        	),
        ),

*/

}
/* End of file Ref_income.php */
/* Location: ./application/controllers/Ref_income.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Custom Codeigniter CRUD Generator 2019-11-08 14:57:14 */