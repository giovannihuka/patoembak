<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Individual extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Individual_model');
        $this->load->library('form_builder');
        $this->load->model('common_model','common_ref');        
	    $this->load->library('datatables');
    }


    private $script = array(
        'assets/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js',
        'assets/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js',
        'assets/dist/admin/individual.js',
    ); 

    private $stylesheet = array(
        // 'assets/datatables/DataTables-1.10.16/css/jquery.dataTables.min.css',
        'assets/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css',
        'assets/jquery-ui-1.12.1.custom/jquery-ui.css',
    );

    private $datepicker_script = array(
        'assets/jquery-ui-1.12.1.custom/jquery-ui.js',
        // 'assets/dist/admin/date_picker.js',
        'assets/dist/admin/date_individual.js',
        'assets/moment/moment.js',
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
        $this->add_script($this->datepicker_script,FALSE,'foot');
        $this->add_stylesheet($this->stylesheet,FALSE,'screen');
        $this->mPageTitle = 'Informasi Data Jiwa'; 
        $this->render('individual/individuals_list');
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
        //     echo $this->Individual_model->json($contractid);
        // }
        // else
        // {
            echo $this->Individual_model->json();
        // }

        /* ------------------------------------------------- */

    }

    public function send_email()
    {
        $this->load->library('email');
        $this->email->from('admin@giovannihuka.com','Admin');
        $this->email->to('giovanni.nttdata@gmail.com');
        // $this->email->cc('giovanni.huka@nttdata.com');
        $this->email->subject('Testing Email');
        $this->email->message('This email is only for testing purpose.<br>Please do not reply...!');

        if ($this->email->send())
        {
            echo 'Email sent!';
        } else 
        {
            $result_email=$this->email->print_debugger();
        };
    }

    // public function bday_list_info()
    // {
    //     var_dump($this->common_ref->bday_list());
    // }

    public function read($id)
    {
        $form = $this->form_builder->create_form();

        $this->add_script($this->select2_script,FALSE,'foot');
        $this->add_stylesheet($this->select2_style,TRUE,'screen');

        $row = $this->Individual_model->get_by_id($id);
            
            if ($row)
            {

                $data = array (
                    'full_name' => $row->full_name,
					'nick_name' => $row->nick_name,
                    'gender' => $row->gender,
                    'blood_typeid' => $row->blood_typeid,
					'birth_date' => $row->birth_date,
					'birth_daynum' => $row->birth_daynum,
					'birth_monthnum' => $row->birth_monthnum,
                    'marriage_status' => $row->marriage_status,
					'birth_city' => $row->birth_city,
					'phone_num' => $row->phone_num,
					'contract_id' => $row->contract_id,
					'status_data' => $row->status_data,
                    'individual_code' => $row->individual_code,
                );
            }

        $this->mViewData['contract_list'] = $this->common_ref->contract_list();
        $this->mViewData['gender_list'] = $this->common_ref->gender_list();
        $this->mViewData['blood_list'] = $this->common_ref->blood_list();
        $this->mViewData['marriage_status'] = $this->common_ref->marriage_status();
        $this->mViewData['individual'] = $data;
        $this->mPageTitle = 'Data Jiwa';
        $this->mViewData['form'] = $form;
        $this->render('individual/individuals_read');
    }

        public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "Jemaat.xls";
        $judul = "Daftar Jemaat";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header('Content-type: application/vnd.ms-excel;charset=UTF-16LE');
        // header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Lengkap");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Panggilan");
        xlsWriteLabel($tablehead, $kolomhead++, "Jenis Kelamin");
        xlsWriteLabel($tablehead, $kolomhead++, "Gol. Darah");
        xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Kelahiran");
        xlsWriteLabel($tablehead, $kolomhead++, "No. Handphone");
        xlsWriteLabel($tablehead, $kolomhead++, "Cabang");
        xlsWriteLabel($tablehead, $kolomhead++, "Status Jemaat");

    foreach ($this->Individual_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
        xlsWriteNumber($tablebody, $kolombody++, $nourut);
        xlsWriteLabel($tablebody, $kolombody++, $data->full_name);
        xlsWriteLabel($tablebody, $kolombody++, $data->nick_name);
        xlsWriteLabel($tablebody, $kolombody++, $data->gender_name);
        xlsWriteLabel($tablebody, $kolombody++, $data->blood_type);
        // xlsWriteLabel($tablebody, $kolombody++, date_format(date_create($data->birth_date),"d-M-Y"));
        xlsWriteLabel($tablebody, $kolombody++, $data->birth_date);
        xlsWriteLabel($tablebody, $kolombody++, $data->phone_num);
        xlsWriteLabel($tablebody, $kolombody++, $data->company_name);
        xlsWriteLabel($tablebody, $kolombody++, $data->status_data);

        $tablebody++;
        $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function delete($id) 
    {
        $row = $this->Individual_model->get_by_id($id);

        if ($row) {
            $this->Individual_model->set_primary_key('id');
            $this->Individual_model->delete($id);
            $this->Individual_model->set_primary_key('id');
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/contract'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/individual'));
        }
    }


    public function disable($id) 
    {
        $row = $this->Individual_model->get_by_id($id);

        $userid = $this->ion_auth->get_user_id();
        $username = $this->ion_auth->get_user_name();
        $contractid = $this->ion_auth->get_contract_id();
        $usergroup = $this->ion_auth->get_users_groups()->row()->name;

        if ($row) {
            $status_data = $row->status_data;

            if ($status_data == 'Aktif') 
            {
                $status_data = 'Tidak Aktif';
            } else {
                $status_data = 'Aktif';
            }

            $data = $this->Individual_model->
            update($id,
                array
                (
                    'status_data' => $status_data,
                    'update_userid' => $userid,
                    'update_time' => time(),
                )
            );

            if ($data)
            {
                $this->system_message->set_success('Data updated successfully');
                // $this->session->set_flashdata('message', 'Update Status Success');
            }
            else
            {
                // $errors = $this->system_message->errors();
                //$this->system_message->set_error($this->system_message->errors());
                $this->session->set_flashdata('message', $this->system_message->errors());
            }
            
            //redirect(site_url('admin/product'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            //redirect(site_url('admin/product'));
        }

        $this->Individual_model->set_primary_key('id');        
        redirect(site_url('admin/individual'));

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
            $full_name = $this->input->post('full_name');
			$nick_name = $this->input->post('nick_name');
            // $individual_code = $this->get_individual_code($full_name,$birth_date);
            $gender = $this->input->post('gender');
            $blood_typeid = $this->input->post('blood_typeid');
			$birth_date = $this->input->post('birth_date');
			$birth_daynum = $this->input->post('birth_daynum');
			$birth_monthnum = $this->input->post('birth_monthnum');
            $marriage_status = $this->input->post('marriage_status');
			$birth_city = $this->input->post('birth_city');
			$phone_num = $this->input->post('phone_num');
			$contract_id = $this->input->post('contract_id');
			$status_data = $this->input->post('status_data');
            $individual_code = $this->get_individual_code($full_name,$birth_date);

    		$data = $this->Individual_model->
        	insert(array
                (
                    'full_name' => $full_name,
					'nick_name' => empty($nick_name)? $full_name:$nick_name,
                    'gender' => $gender,
                    'blood_typeid' => empty($blood_typeid)? NULL:$blood_typeid,
                    'birth_date' => $birth_date,
					'birth_daynum' => date_parse_from_format('Y-m-d',$birth_date)['day'],
                    'birth_monthnum' => date_parse_from_format('Y-m-d',$birth_date)['month'],
					'birth_city' => $birth_city,
                    'marriage_status' => empty($marriage_status)? 1:$marriage_status,
					'phone_num' => str_replace('_', '', $phone_num),
					'contract_id' => $contract_id,
					'status_data' => 'Aktif', // '1' = Data Baru; '2' = Aktif; '3' = Tidak Aktif
					'create_userid' => $userid,
					'update_userid' => $userid,
					'create_time' => time(),
					'update_time' => time(),
                    'individual_code' => $this->get_individual_code($full_name,$birth_date),
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

        $this->mViewData['contract_list'] = $this->common_ref->contract_list();
        $this->mViewData['status_list'] = $this->common_ref->status_list();
        $this->mViewData['gender_list'] = $this->common_ref->gender_list();
        $this->mViewData['blood_list'] = $this->common_ref->blood_list();
        $this->mViewData['marriage_status'] = $this->common_ref->marriage_status();
        $this->mViewData['individual'] = $this->Individual_model->get_all();
        $this->mPageTitle = 'Registrasi Data Jiwa';
        $this->mViewData['form'] = $form;
        $this->render('individual/individuals_form');
        
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
            $full_name = $this->input->post('full_name');
			$nick_name = $this->input->post('nick_name');
            $gender = $this->input->post('gender');
            $blood_typeid = $this->input->post('blood_typeid');
			$birth_date = $this->input->post('birth_date');
			$birth_city = $this->input->post('birth_city');
            $marriage_status = $this->input->post('marriage_status');
			$phone_num = $this->input->post('phone_num');
			$contract_id = $this->input->post('contract_id');
            $status_data = $this->input->post('status_data');
            $individual_code = $this->get_individual_code($full_name,$birth_date);

            $this->Individual_model->set_primary_key('id');

            $data = $this->Individual_model->
            update($id,
                array
                (
                    'full_name' => $full_name,
					'nick_name' => empty($nick_name)? $full_name:$nick_name,
                    'gender' => $gender,
                    'blood_typeid' => empty($blood_typeid)? NULL:$blood_typeid,
					'birth_date' => $birth_date,
					'birth_daynum' => date_parse_from_format('Y-m-d',$birth_date)['day'],
                    'birth_monthnum' => date_parse_from_format('Y-m-d',$birth_date)['month'],
					'birth_city' => empty($birth_city)? NULL:$birth_city,
                    'marriage_status' => empty($marriage_status)? 1:$marriage_status,
					'phone_num' => str_replace('_', '', $phone_num),
					'contract_id' => $contract_id,
					'status_data' => $status_data,
					'update_userid' => $userid,
					'update_time' => time(),
                    'individual_code' => $this->get_individual_code($full_name,$birth_date),
				)
    );

    $this->Individual_model->set_primary_key('id');

    if ($data)
    {
        // $this->get_individual_code($full_name,$birth_date);
        $this->system_message->set_success('Data updated successfully');
    }
    else
    {
        // $errors = $this->system_message->errors();
        $this->system_message->set_error($this->system_message->errors());
    }

    refresh();

    } else {

    $row = $this->Individual_model->get_by_id($id);

    if ($row)
    {

        $data = array (
                    'individual_code' => $row->individual_code,
                    'full_name' => $row->full_name,
					'nick_name' => $row->nick_name,
                    'gender' => $row->gender,
                    'blood_typeid' => $row->blood_typeid,
					'birth_date' => $row->birth_date,
                    'birth_city' => $row->birth_city,
                    'marriage_status' => $row->marriage_status,
					'phone_num' => $row->phone_num,
					'contract_id' => $row->contract_id,
					'status_data' => $row->status_data,
					'button' => 'Update',
                );
            }

        }

        $this->mViewData['contract_list'] = $this->common_ref->contract_list();
        $this->mViewData['status_list'] = $this->common_ref->status_list();
        $this->mViewData['gender_list'] = $this->common_ref->gender_list();
        $this->mViewData['blood_list'] = $this->common_ref->blood_list();
        $this->mViewData['marriage_status'] = $this->common_ref->marriage_status();
        $this->mViewData['individual'] = $data;
        $this->mPageTitle = 'Ubah Data Jiwa';
        $this->mViewData['form'] = $form;
        $this->render('individual/individuals_update');
        
	}


/* 
Please copy this section into ../application/modules/admin/config/form_validation.php

	'individual/create' => array(
			array(
            	'field'		 => 'first_name',
            	'label'		 => 'Nama Depan',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'middle_name',
            	'label'		 => 'Nama Tengah',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'last_name',
            	'label'		 => 'Nama Belakang',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'nick_name',
            	'label'		 => 'Nama Panggilan',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'birth_date',
            	'label'		 => 'Tanggal Kelahiran',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'birth_daynum',
            	'label'		 => 'Hari Kelahiran',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'birth_monthnum',
            	'label'		 => 'Bulan Kelahiran',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'birth_city',
            	'label'		 => 'Kota Kelahiran',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'phone_num',
            	'label'		 => 'No. Handphone',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'contract_id',
            	'label'		 => 'Cabang',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'status_data',
            	'label'		 => 'Status Data',
            	'rules'		 => 'trim|required',
        	),
        ),


	'individual/update' => array(
			array(
            	'field'		 => 'first_name',
            	'label'		 => 'Nama Depan',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'middle_name',
            	'label'		 => 'Nama Tengah',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'last_name',
            	'label'		 => 'Nama Belakang',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'nick_name',
            	'label'		 => 'Nama Panggilan',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'birth_date',
            	'label'		 => 'Tanggal Kelahiran',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'birth_daynum',
            	'label'		 => 'Hari Kelahiran',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'birth_monthnum',
            	'label'		 => 'Bulan Kelahiran',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'birth_city',
            	'label'		 => 'Kota Kelahiran',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'phone_num',
            	'label'		 => 'No. Handphone',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'contract_id',
            	'label'		 => 'Cabang',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'status_data',
            	'label'		 => 'Status Data',
            	'rules'		 => 'trim|required',
        	),
        ),

*/

}
/* End of file individual.php */
/* Location: ./application/controllers/individual.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Custom Codeigniter CRUD Generator 2018-08-13 15:29:51 */