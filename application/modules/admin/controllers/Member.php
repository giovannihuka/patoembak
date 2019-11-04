<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Member_model');
        $this->load->library('form_builder');
        $this->load->model('common_model','common_ref');        
	    $this->load->library('datatables');
    }

    private $script = array(
        'assets/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js',
        'assets/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js',
        'assets/dist/admin/member.js',
    ); 

    private $stylesheet = array(
        // 'assets/datatables/DataTables-1.10.16/css/jquery.dataTables.min.css',
        'assets/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css',
        'assets/jquery-ui-1.12.1.custom/jquery-ui.css',
    );

    private $datepicker_script = array(
        'assets/jquery-ui-1.12.1.custom/jquery-ui.js',
        'assets/dist/admin/date_picker.js',
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
        $this->mPageTitle = 'Daftar Jemaat'; 
        $this->render('member/members_list');
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
        //     echo $this->Member_model->json($contractid);
        // }
        // else
        // {
            echo $this->Member_model->json();
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

    public function read($id)
    {
        $form = $this->form_builder->create_form();

        $this->add_script($this->select2_script,FALSE,'foot');
        $this->add_stylesheet($this->select2_style,TRUE,'screen');

        $row = $this->Member_model->get_by_id($id);
            
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
					'birth_city' => $row->birth_city,
					'phone_num' => $row->phone_num,
					'contract_id' => $row->contract_id,
					'status_data' => $row->status_data,

                );
            }

        $this->mViewData['contract_list'] = $this->common_ref->contract_list();
        $this->mViewData['gender_list'] = $this->common_ref->gender_list();
        $this->mViewData['blood_list'] = $this->common_ref->blood_list();
        $this->mViewData['member'] = $data;
        $this->mPageTitle = 'Jemaat';
        $this->mViewData['form'] = $form;
        $this->render('member/members_read');
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

    foreach ($this->Member_model->get_all() as $data) {
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
        $row = $this->Member_model->get_by_id($id);

        if ($row) {
            $this->Member_model->set_primary_key('id');
            $this->Member_model->delete($id);
            $this->Member_model->set_primary_key('id');
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/member'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/member'));
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
            $full_name = $this->input->post('full_name');
			$nick_name = $this->input->post('nick_name');
            $gender = $this->input->post('gender');
            $blood_typeid = $this->input->post('blood_typeid');
			$birth_date = $this->input->post('birth_date');
			$birth_daynum = $this->input->post('birth_daynum');
			$birth_monthnum = $this->input->post('birth_monthnum');
			$birth_city = $this->input->post('birth_city');
			$phone_num = $this->input->post('phone_num');
			$contract_id = $this->input->post('contract_id');
			$status_data = $this->input->post('status_data');

    		$data = $this->Member_model->
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
					'phone_num' => str_replace('_', '', $phone_num),
					'contract_id' => $contract_id,
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

        $this->mViewData['contract_list'] = $this->common_ref->contract_list();
        $this->mViewData['status_list'] = $this->common_ref->status_list();
        $this->mViewData['gender_list'] = $this->common_ref->gender_list();
        $this->mViewData['blood_list'] = $this->common_ref->blood_list();
        $this->mViewData['member'] = $this->Member_model->get_all();
        $this->mPageTitle = 'Registrasi Jemaat';
        $this->mViewData['form'] = $form;
        $this->render('member/members_form');
        
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
			$phone_num = $this->input->post('phone_num');
			$contract_id = $this->input->post('contract_id');
            $status_data = $this->input->post('status_data');

            $this->Member_model->set_primary_key('id');

            $data = $this->Member_model->
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
					'phone_num' => str_replace('_', '', $phone_num),
					'contract_id' => $contract_id,
					'status_data' => $status_data,
					'update_userid' => $userid,
					'update_time' => time(),
				)
    );

    $this->Member_model->set_primary_key('id');

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

    $row = $this->Member_model->get_by_id($id);

    if ($row)
    {

        $data = array (
                    'full_name' => $row->full_name,
					'nick_name' => $row->nick_name,
                    'gender' => $row->gender,
                    'blood_typeid' => $row->blood_typeid,
					'birth_date' => $row->birth_date,
                    'birth_city' => $row->birth_city,
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
        $this->mViewData['member'] = $data;
        $this->mPageTitle = 'Ubah Jemaat';
        $this->mViewData['form'] = $form;
        $this->render('member/members_update');
        
	}


/* 
Please copy this section into ../application/modules/admin/config/form_validation.php

	'member/create' => array(
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


	'member/update' => array(
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
/* End of file Member.php */
/* Location: ./application/controllers/Member.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Custom Codeigniter CRUD Generator 2018-08-13 15:29:51 */