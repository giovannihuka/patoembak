<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Scripture extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Scripture_model');
        $this->load->library('form_builder');
        $this->load->model('common_model','common_ref');        
	    $this->load->library('datatables');
    }

    private $script = array(
        'assets/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js',
        'assets/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js',
        'assets/dist/admin/scripture.js',
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
        $this->mPageTitle = 'Informasi Firman Tuhan'; 
        $this->render('scripture/scriptures_list');
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
        //     echo $this->Scripture_model->json($contractid);
        // }
        // else
        // {
            echo $this->Scripture_model->json();
        // }

        /* ------------------------------------------------- */

    }

    public function read($id)
    {
        $form = $this->form_builder->create_form();

        $row = $this->Scripture_model->get_by_id($id);
            
            if ($row)
            {

                $data = array (

					'scriptures_text' => $row->scriptures_text,
					'scripture_section' => $row->scripture_section,
					'start_date' => $row->start_date,
					'end_date' => $row->end_date,
					'status_data' => $row->status_data,

                );
            }

        $this->mViewData['scripture'] = $data;
        $this->mPageTitle = 'Firman Tuhan';
        $this->mViewData['form'] = $form;
        $this->render('scripture/scriptures_read');
    }

    public function delete($id) 
    {
        $row = $this->Scripture_model->get_by_id($id);

        if ($row) {
            $this->Scripture_model->set_primary_key('id');
            $this->Scripture_model->delete($id);
            $this->Scripture_model->set_primary_key('id');
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/scripture'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/scripture'));
        }
    }


    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "scriptures.xls";
        $judul = "scriptures";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Scriptures Text");
	xlsWriteLabel($tablehead, $kolomhead++, "Scripture Section");
	xlsWriteLabel($tablehead, $kolomhead++, "Start Date");
	xlsWriteLabel($tablehead, $kolomhead++, "End Date");
	xlsWriteLabel($tablehead, $kolomhead++, "Status Data");
	xlsWriteLabel($tablehead, $kolomhead++, "Create Userid");
	xlsWriteLabel($tablehead, $kolomhead++, "Update Userid");
	xlsWriteLabel($tablehead, $kolomhead++, "Create Time");
	xlsWriteLabel($tablehead, $kolomhead++, "Update Time");

	foreach ($this->Scripture_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->scriptures_text);
	    xlsWriteLabel($tablebody, $kolombody++, $data->scripture_section);
	    xlsWriteLabel($tablebody, $kolombody++, $data->start_date);
	    xlsWriteLabel($tablebody, $kolombody++, $data->end_date);
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
			$scriptures_text = $this->input->post('scriptures_text');
			$scripture_section = $this->input->post('scripture_section');
			$start_date = $this->input->post('start_date');
			$end_date = $this->input->post('end_date');
			$status_data = $this->input->post('status_data');

    		$data = $this->Scripture_model->
        	insert(array
                (
					'scriptures_text' => $scriptures_text,
					'scripture_section' => $scripture_section,
					'start_date' => $start_date,
					'end_date' => $end_date,
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

        $this->mViewData['scripture'] = $this->Scripture_model->get_all();
        $this->mPageTitle = 'Registrasi Firman Tuhan';
        $this->mViewData['form'] = $form;
        $this->render('scripture/scriptures_form');
        
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
			$scriptures_text = $this->input->post('scriptures_text');
			$scripture_section = $this->input->post('scripture_section');
			$start_date = $this->input->post('start_date');
			$end_date = $this->input->post('end_date');
			$status_data = $this->input->post('status_data');

            $this->Scripture_model->set_primary_key('id');

            $data = $this->Scripture_model->
            update($id,
                array
                (
					'scriptures_text' => $scriptures_text,
					'scripture_section' => $scripture_section,
					'start_date' => $start_date,
					'end_date' => $end_date,
					'status_data' => $status_data,
					'update_userid' => $userid,
					'update_time' => time(),
				)
    );

    $this->Scripture_model->set_primary_key('id');

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

    $row = $this->Scripture_model->get_by_id($id);

    if ($row)
    {

        $data = array (
					'scriptures_text' => $row->scriptures_text,
					'scripture_section' => $row->scripture_section,
					'start_date' => $row->start_date,
					'end_date' => $row->end_date,
					'status_data' => $row->status_data,
					'button' => 'Update',
                );
            }

        }

        $this->mViewData['scripture'] = $data;
        $this->mViewData['status_list'] = $this->common_ref->status_list();
        $this->mPageTitle = 'Ubah Firman Tuhan';
        $this->mViewData['form'] = $form;
        $this->render('scripture/scriptures_update');
        
	}


/* 
Please copy this section into ../application/modules/admin/config/form_validation.php

	'scripture/create' => array(
			array(
            	'field'		 => 'scriptures_text',
            	'label'		 => 'Firman Tuhan',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'scripture_section',
            	'label'		 => 'Pasal Alkitab',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'start_date',
            	'label'		 => 'Tgl. Awal',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'end_date',
            	'label'		 => 'Tgl. Selesai',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'status_data',
            	'label'		 => 'Status Data',
            	'rules'		 => 'trim|required',
        	),
        ),


	'scripture/update' => array(
			array(
            	'field'		 => 'scriptures_text',
            	'label'		 => 'Firman Tuhan',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'scripture_section',
            	'label'		 => 'Pasal Alkitab',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'start_date',
            	'label'		 => 'Tgl. Awal',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'end_date',
            	'label'		 => 'Tgl. Selesai',
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
/* End of file Scripture.php */
/* Location: ./application/controllers/Scripture.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Custom Codeigniter CRUD Generator 2019-10-14 17:02:52 */