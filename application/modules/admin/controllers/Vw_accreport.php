<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Vw_accreport extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Vw_accreport_model');
        $this->load->library('form_builder');
        $this->load->model('common_model','common_ref');        
	    $this->load->library('datatables');
    }

    private $script = array(
        'assets/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js',
        'assets/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js',
        'assets/dist/admin/vw_accreport.js',
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
        $this->mPageTitle = 'Informasi VIEW'; 
        $this->render('vw_accreport/vw_accreports_list');
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
        //     echo $this->Vw_accreport_model->json($contractid);
        // }
        // else
        // {
            echo $this->Vw_accreport_model->json();
        // }

        /* ------------------------------------------------- */

    }

    public function read($id)
    {
        $form = $this->form_builder->create_form();

        $row = $this->Vw_accreport_model->get_by_id($id);
            
            if ($row)
            {

                $data = array (

					'activity_date' => $row->activity_date,
					'yearnum' => $row->yearnum,
					'monthnum' => $row->monthnum,
					'weeknum' => $row->weeknum,
					'activity_name' => $row->activity_name,
					'amount' => $row->amount,
					'people' => $row->people,

                );
            }

        $this->mViewData['vw_accreport'] = $data;
        $this->mPageTitle = 'VIEW';
        $this->mViewData['form'] = $form;
        $this->render('vw_accreport/vw_accreports_read');
    }

    public function delete($id) 
    {
        $row = $this->Vw_accreport_model->get_by_id($id);

        if ($row) {
            $this->Vw_accreport_model->set_primary_key('');
            $this->Vw_accreport_model->delete($id);
            $this->Vw_accreport_model->set_primary_key('id');
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/vw_accreport'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/vw_accreport'));
        }
    }


    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "vw_accreports.xls";
        $judul = "vw_accreports";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Activity Date");
	xlsWriteLabel($tablehead, $kolomhead++, "Yearnum");
	xlsWriteLabel($tablehead, $kolomhead++, "Monthnum");
	xlsWriteLabel($tablehead, $kolomhead++, "Weeknum");
	xlsWriteLabel($tablehead, $kolomhead++, "Activity Name");
	xlsWriteLabel($tablehead, $kolomhead++, "Amount");
	xlsWriteLabel($tablehead, $kolomhead++, "People");

	foreach ($this->Vw_accreport_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->activity_date);
	    xlsWriteNumber($tablebody, $kolombody++, $data->yearnum);
	    xlsWriteNumber($tablebody, $kolombody++, $data->monthnum);
	    xlsWriteNumber($tablebody, $kolombody++, $data->weeknum);
	    xlsWriteLabel($tablebody, $kolombody++, $data->activity_name);
	    xlsWriteNumber($tablebody, $kolombody++, $data->amount);
	    xlsWriteNumber($tablebody, $kolombody++, $data->people);

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
			$activity_date = $this->input->post('activity_date');
			$yearnum = $this->input->post('yearnum');
			$monthnum = $this->input->post('monthnum');
			$weeknum = $this->input->post('weeknum');
			$activity_name = $this->input->post('activity_name');
			$amount = $this->input->post('amount');
			$people = $this->input->post('people');

    		$data = $this->Vw_accreport_model->
        	insert(array
                (
					'activity_date' => $activity_date,
					'yearnum' => $yearnum,
					'monthnum' => $monthnum,
					'weeknum' => $weeknum,
					'activity_name' => $activity_name,
					'amount' => $amount,
					'people' => $people,
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

        $this->mViewData['vw_accreport'] = $this->Vw_accreport_model->get_all();
        $this->mPageTitle = 'Registrasi VIEW';
        $this->mViewData['form'] = $form;
        $this->render('vw_accreport/vw_accreports_form');
        
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
			$activity_date = $this->input->post('activity_date');
			$yearnum = $this->input->post('yearnum');
			$monthnum = $this->input->post('monthnum');
			$weeknum = $this->input->post('weeknum');
			$activity_name = $this->input->post('activity_name');
			$amount = $this->input->post('amount');
			$people = $this->input->post('people');

            $this->Vw_accreport_model->set_primary_key('');

            $data = $this->Vw_accreport_model->
            update($id,
                array
                (
					'activity_date' => $activity_date,
					'yearnum' => $yearnum,
					'monthnum' => $monthnum,
					'weeknum' => $weeknum,
					'activity_name' => $activity_name,
					'amount' => $amount,
					'people' => $people,
				)
    );

    $this->Vw_accreport_model->set_primary_key('id');

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

    $row = $this->Vw_accreport_model->get_by_id($id);

    if ($row)
    {

        $data = array (
					'activity_date' => $row->activity_date,
					'yearnum' => $row->yearnum,
					'monthnum' => $row->monthnum,
					'weeknum' => $row->weeknum,
					'activity_name' => $row->activity_name,
					'amount' => $row->amount,
					'people' => $row->people,
					'button' => 'Update',
                );
            }

        }

        $this->mViewData['vw_accreport'] = $data;
        $this->mViewData['status_list'] = $this->common_ref->status_list();
        $this->mPageTitle = 'Ubah VIEW';
        $this->mViewData['form'] = $form;
        $this->render('vw_accreport/vw_accreports_update');
        
	}


/* 
Please copy this section into ../application/modules/admin/config/form_validation.php

	'vw_accreport/create' => array(
			array(
            	'field'		 => 'activity_date',
            	'label'		 => 'Tanggal Aktifitas',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'yearnum',
            	'label'		 => 'Yearnum',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'monthnum',
            	'label'		 => 'Monthnum',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'weeknum',
            	'label'		 => 'Weeknum',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'activity_name',
            	'label'		 => 'Nama Kegiatan',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'amount',
            	'label'		 => 'Amount',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'people',
            	'label'		 => 'People',
            	'rules'		 => 'trim|required|numeric',
        	),
        ),


	'vw_accreport/update' => array(
			array(
            	'field'		 => 'activity_date',
            	'label'		 => 'Tanggal Aktifitas',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'yearnum',
            	'label'		 => 'Yearnum',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'monthnum',
            	'label'		 => 'Monthnum',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'weeknum',
            	'label'		 => 'Weeknum',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'activity_name',
            	'label'		 => 'Nama Kegiatan',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'amount',
            	'label'		 => 'Amount',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'people',
            	'label'		 => 'People',
            	'rules'		 => 'trim|required|numeric',
        	),
        ),

*/

}
/* End of file Vw_accreport.php */
/* Location: ./application/controllers/Vw_accreport.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Custom Codeigniter CRUD Generator 2020-03-02 07:08:18 */