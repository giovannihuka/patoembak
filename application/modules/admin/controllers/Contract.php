<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contract extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Contract_model');
        $this->load->library('form_builder');
        $this->load->model('common_model','common_ref');
        // $this->load->model('Map_model','maps');        
	    $this->load->library('datatables');
    }

    private $script = array(
        'assets/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js',
        'assets/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js',
        'assets/dist/admin/contract.js',
    ); 

    private $stylesheet = array(
        // 'assets/datatables/DataTables-1.10.16/css/jquery.dataTables.min.css',
        'assets/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css',
        'assets/jquery-ui-1.12.1.custom/jquery-ui.css',

    );

    private $datepicker_script = array(
        // 'assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
        
        // 'assets/jquery-ui-1.12.1.custom/external/jquery/jquery.js',
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

    private $select2_style = array(
        'assets/select2/select2.min.css',
    );

     private $select2_script = array(
        'assets/select2/select2.full.min.js',
        'assets/dist/admin/select2.js',
    );

    private $glo_category_script = array(
        'assets/dist/admin/prod_categorization.js',
    );

    public function index()
    {
        $this->add_script($this->script,FALSE,'foot');
        $this->add_stylesheet($this->stylesheet,FALSE,'screen');
        $this->mPageTitle = 'Informasi Profil Gereja'; 
        $this->render('contract/contracts_list');
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
        //     echo $this->Contract_model->json($contractid);
        // }
        // else
        // {
            echo $this->Contract_model->json();
        // }

        /* ------------------------------------------------- */

    }

    public function read($id)
    {
        $this->load->library('leaflet');
        $this->add_script('https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.3/leaflet.js',FALSE,'foot');
        $this->add_stylesheet('https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.3/leaflet.css',FALSE,'screen');
        $form = $this->form_builder->create_form();

        $config = array();
        // $this->add_script('https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.3/leaflet.js',FALSE,'foot');
        // $this->add_stylesheet('https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.3/leaflet.css',FALSE,'screen');

        $row = $this->Contract_model->get_by_id($id);
            
            if ($row)
            {

                $data = array (

					'company_name' => $row->company_name,
					'pic_name' => $row->pic_name,
					'company_address' => $row->company_address,
                    'long_info' => $row->long_info,
                    'lat_info' => $row->lat_info,
					'company_phone1' => $row->company_phone1,
					'company_phone2' => $row->company_phone2,
					'pic_phone' => $row->pic_phone,
					'email_address' => $row->email_address,
					'start_date' => $row->start_date,
					'terminate_date' => $row->terminate_date,
					'status_data' => $row->status_data,

                );

                $config = array(
                    'center' => $row->long_info .', '. $row->lat_info,
                    'fitBounds' => '[['.$row->long_info .','.$row->lat_info.'],['.$row->long_info .','.$row->lat_info.']]',
                    'zoom' => '6',
                );
            }

        $this->leaflet->initialize($config);

        $html = '<table><tr><td style=\'font-weight:bold;\'>'.$data['company_name'].'</td></tr><tr><td>'.$data['pic_name'].'</td></tr></table>';
        
        $marker = array(
            'latlng'        => $data['long_info'].','.$data['lat_info'],
            'popupContent'  => $html,
        );
        $this->leaflet->add_marker($marker);

        $this->mViewData['map'] = $this->leaflet->create_map();
        $this->mViewData['contract'] = $data;
        $this->mPageTitle = 'Profil Gereja';
        $this->mViewData['form'] = $form;
        $this->render('contract/contracts_read');
    }

    public function delete($id) 
    {
        $row = $this->Contract_model->get_by_id($id);

        if ($row) {
            $this->Contract_model->set_primary_key('contract_id');
            $this->Contract_model->delete($id);
            $this->Contract_model->set_primary_key('id');
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/contract'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/contract'));
        }
    }


    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "Gereja.xls";
        $judul = "Informasi Profil Gereja";
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
    	xlsWriteLabel($tablehead, $kolomhead++, "Nama Gereja");
    	xlsWriteLabel($tablehead, $kolomhead++, "Nama Gembala");
    	xlsWriteLabel($tablehead, $kolomhead++, "Alamat Gereja");
        xlsWriteLabel($tablehead, $kolomhead++, "Langtitude");
        xlsWriteLabel($tablehead, $kolomhead++, "Latitude");
    	xlsWriteLabel($tablehead, $kolomhead++, "Telepon");
    	xlsWriteLabel($tablehead, $kolomhead++, "Telepon Lain");
    	xlsWriteLabel($tablehead, $kolomhead++, "Hand Phone");
    	xlsWriteLabel($tablehead, $kolomhead++, "Alamat Email");
    	xlsWriteLabel($tablehead, $kolomhead++, "Tgl. Berdiri");
    	xlsWriteLabel($tablehead, $kolomhead++, "Tgl. Tutup");

	foreach ($this->Contract_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->company_name);
	    xlsWriteLabel($tablebody, $kolombody++, $data->pic_name);
	    xlsWriteLabel($tablebody, $kolombody++, $data->company_address);
        xlsWriteLabel($tablebody, $kolombody++, $data->long_info);
        xlsWriteLabel($tablebody, $kolombody++, $data->lat_info);
	    xlsWriteLabel($tablebody, $kolombody++, $data->company_phone1);
	    xlsWriteLabel($tablebody, $kolombody++, $data->company_phone2);
	    xlsWriteLabel($tablebody, $kolombody++, $data->pic_phone);
	    xlsWriteLabel($tablebody, $kolombody++, $data->email_address);
	    xlsWriteLabel($tablebody, $kolombody++, $data->start_date);
	    xlsWriteLabel($tablebody, $kolombody++, $data->terminate_date);

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
			$company_name = $this->input->post('company_name');
			$pic_name = $this->input->post('pic_name');
            $company_address = $this->input->post('company_address');
            $long_info = $this->input->post('long_info');
            $lat_info = $this->input->post('lat_info');
			$company_phone1 = $this->input->post('company_phone1');
			$company_phone2 = $this->input->post('company_phone2');
			$pic_phone = $this->input->post('pic_phone');
			$email_address = $this->input->post('email_address');
			$start_date = $this->input->post('start_date');
			$terminate_date = $this->input->post('terminate_date');

    		$data = $this->Contract_model->
        	insert(array
                (
					'company_name' => $company_name,
					'pic_name' => $pic_name,
                    'company_address' => $company_address,
                    'long_info' => $long_info,
                    'lat_info' => $lat_info,
                    'company_phone1' => empty($company_phone1)? NULL:str_replace('_','',$company_phone1),
                    'company_phone2' => empty($company_phone2)? NULL:str_replace('_','',$company_phone2),
					'pic_phone' => $pic_phone,
					'email_address' => $email_address,
					'start_date' => $start_date,
					'terminate_date' => empty($terminate_date)? NULL:$terminate_date,
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

        $this->mViewData['contract'] = $this->Contract_model->get_all();
        $this->mViewData['pastor_list'] = $this->common_ref->pastor_list();
        $this->mViewData['status_list'] = $this->common_ref->status_list();
        $this->mPageTitle = 'Registrasi Profil Gereja';
        $this->mViewData['form'] = $form;
        $this->render('contract/contracts_form');
        
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
			$company_name = $this->input->post('company_name');
			$pic_name = $this->input->post('pic_name');
			$company_address = $this->input->post('company_address');
            $long_info = $this->input->post('long_info');
            $lat_info = $this->input->post('lat_info');
			$company_phone1 = $this->input->post('company_phone1');
			$company_phone2 = $this->input->post('company_phone2');
			$pic_phone = $this->input->post('pic_phone');
			$email_address = $this->input->post('email_address');
			$start_date = $this->input->post('start_date');
			$terminate_date = $this->input->post('terminate_date');
			$status_data = $this->input->post('status_data');

            $this->Contract_model->set_primary_key('contract_id');

            $data = $this->Contract_model->
            update($id,
                array
                (
					'company_name' => $company_name,
					'pic_name' => $pic_name,
					'company_address' => $company_address,
                    'long_info' => $long_info,
                    'lat_info' => $lat_info,
                    'company_phone1' => empty($company_phone1)? NULL:str_replace('_','',$company_phone1),
                    'company_phone2' => empty($company_phone2)? NULL:str_replace('_','',$company_phone2),
					'pic_phone' => $pic_phone,
					'email_address' => $email_address,
					'start_date' => $start_date,
					'terminate_date' => empty($terminate_date)? NULL:$terminate_date,
					'status_data' => $status_data,
					'update_userid' => $userid,
					'update_time' => time(),
				)
    );

    $this->Contract_model->set_primary_key('id');

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

    $row = $this->Contract_model->get_by_id($id);

    if ($row)
    {

        $data = array (
					'company_name' => $row->company_name,
					'pic_name' => $row->pic_name,
					'company_address' => $row->company_address,
                    'long_info' => $row->long_info,
                    'lat_info' => $row->lat_info,
					'company_phone1' => $row->company_phone1,
					'company_phone2' => $row->company_phone2,
					'pic_phone' => $row->pic_phone,
					'email_address' => $row->email_address,
					'start_date' => $row->start_date,
					'terminate_date' => $row->terminate_date,
					'status_data' => $row->status_data,
					'button' => 'Update',
                );
            }

        }

        $this->mViewData['contract'] = $data;
        $this->mViewData['pastor_list'] = $this->common_ref->pastor_list();
        $this->mViewData['status_list'] = $this->common_ref->status_list();
        $this->mPageTitle = 'Ubah Profil Gereja';
        $this->mViewData['form'] = $form;
        $this->render('contract/contracts_update');
        
	}


/* 
Please copy this section into ../application/modules/admin/config/form_validation.php

	'contract/create' => array(
			array(
            	'field'		 => 'company_name',
            	'label'		 => 'Nama Gereja',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'pic_name',
            	'label'		 => 'Nama Gembala',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'company_address',
            	'label'		 => 'Alamat Gereja',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'company_phone1',
            	'label'		 => 'Telepon',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'company_phone2',
            	'label'		 => 'Telepon Lain',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'pic_phone',
            	'label'		 => 'Hand Phone',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'email_address',
            	'label'		 => 'Email',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'start_date',
            	'label'		 => 'Tanggal Berdiri',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'terminate_date',
            	'label'		 => 'Tanggal Tutup',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'status_data',
            	'label'		 => 'Status Data',
            	'rules'		 => 'trim|required',
        	),
        ),


	'contract/update' => array(
			array(
            	'field'		 => 'company_name',
            	'label'		 => 'Nama Gereja',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'pic_name',
            	'label'		 => 'Nama Gembala',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'company_address',
            	'label'		 => 'Alamat Gereja',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'company_phone1',
            	'label'		 => 'Telepon',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'company_phone2',
            	'label'		 => 'Telepon Lain',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'pic_phone',
            	'label'		 => 'Hand Phone',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'email_address',
            	'label'		 => 'Email',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'start_date',
            	'label'		 => 'Tanggal Berdiri',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'terminate_date',
            	'label'		 => 'Tanggal Tutup',
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
/* End of file Contract.php */
/* Location: ./application/controllers/Contract.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Custom Codeigniter CRUD Generator 2018-08-03 10:05:15 */
