<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Fin_sum extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Fin_sum_model');
        $this->load->library('form_builder');
        $this->load->model('common_model','common_ref');        
	    $this->load->library('datatables');
    }

    private $script = array(
        'assets/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js',
        'assets/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js',
        'assets/dist/admin/fin_sum.js',
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
        $this->mPageTitle = 'Informasi Resume Finansial dan Jemaat'; 
        $this->render('fin_sum/fin_sums_list');
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
        //     echo $this->Fin_sum_model->json($contractid);
        // }
        // else
        // {
            echo $this->Fin_sum_model->json();
        // }

        /* ------------------------------------------------- */

    }

    public function read($id)
    {
        $form = $this->form_builder->create_form();

        $row = $this->Fin_sum_model->get_by_id($id);
            
            if ($row)
            {

                $data = array (

					'year_num' => $row->year_num,
					'month_num' => $row->month_num,
					'week_num' => $row->week_num,
					'qty_person' => $row->qty_person,
					'amount' => $row->amount,
					'status_data' => $row->status_data,

                );
            }

        $this->mViewData['fin_sum'] = $data;
        $this->mPageTitle = 'Resume Finansial dan Jemaat';
        $this->mViewData['form'] = $form;
        $this->render('fin_sum/fin_sums_read');
    }

    public function delete($id) 
    {
        $row = $this->Fin_sum_model->get_by_id($id);

        if ($row) {
            $this->Fin_sum_model->set_primary_key('id');
            $this->Fin_sum_model->delete($id);
            $this->Fin_sum_model->set_primary_key('id');
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/fin_sum'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/fin_sum'));
        }
    }


    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "fin_sums.xls";
        $judul = "fin_sums";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Year Num");
	xlsWriteLabel($tablehead, $kolomhead++, "Month Num");
	xlsWriteLabel($tablehead, $kolomhead++, "Week Num");
	xlsWriteLabel($tablehead, $kolomhead++, "Qty Person");
	xlsWriteLabel($tablehead, $kolomhead++, "Amount");
	xlsWriteLabel($tablehead, $kolomhead++, "Status Data");
	xlsWriteLabel($tablehead, $kolomhead++, "Create Userid");
	xlsWriteLabel($tablehead, $kolomhead++, "Update Userid");
	xlsWriteLabel($tablehead, $kolomhead++, "Create Time");
	xlsWriteLabel($tablehead, $kolomhead++, "Update Time");

	foreach ($this->Fin_sum_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->year_num);
	    xlsWriteNumber($tablebody, $kolombody++, $data->month_num);
	    xlsWriteNumber($tablebody, $kolombody++, $data->week_num);
	    xlsWriteNumber($tablebody, $kolombody++, $data->qty_person);
	    xlsWriteNumber($tablebody, $kolombody++, $data->amount);
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
			$year_num = $this->input->post('year_num');
			$month_num = $this->input->post('month_num');
			$week_num = $this->input->post('week_num');
			$qty_person = $this->input->post('qty_person');
			$amount = $this->input->post('amount');
			$status_data = $this->input->post('status_data');

    		$data = $this->Fin_sum_model->
        	insert(array
                (
					'year_num' => $year_num,
					'month_num' => $month_num,
					'week_num' => $week_num,
					'qty_person' => $qty_person,
					'amount' => $amount,
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

        $this->mViewData['fin_sum'] = $this->Fin_sum_model->get_all();
        $this->mPageTitle = 'Registrasi Resume Finansial dan Jemaat';
        $this->mViewData['form'] = $form;
        $this->render('fin_sum/fin_sums_form');
        
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
			$year_num = $this->input->post('year_num');
			$month_num = $this->input->post('month_num');
			$week_num = $this->input->post('week_num');
			$qty_person = $this->input->post('qty_person');
			$amount = $this->input->post('amount');
			$status_data = $this->input->post('status_data');

            $this->Fin_sum_model->set_primary_key('id');

            $data = $this->Fin_sum_model->
            update($id,
                array
                (
					'year_num' => $year_num,
					'month_num' => $month_num,
					'week_num' => $week_num,
					'qty_person' => $qty_person,
					'amount' => $amount,
					'status_data' => $status_data,
					'update_userid' => $userid,
					'update_time' => time(),
				)
    );

    $this->Fin_sum_model->set_primary_key('id');

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

    $row = $this->Fin_sum_model->get_by_id($id);

    if ($row)
    {

        $data = array (
					'year_num' => $row->year_num,
					'month_num' => $row->month_num,
					'week_num' => $row->week_num,
					'qty_person' => $row->qty_person,
					'amount' => $row->amount,
					'status_data' => $row->status_data,
					'button' => 'Update',
                );
            }

        }

        $this->mViewData['fin_sum'] = $data;
        $this->mViewData['status_list'] = $this->common_ref->status_list();
        $this->mPageTitle = 'Ubah Resume Finansial dan Jemaat';
        $this->mViewData['form'] = $form;
        $this->render('fin_sum/fin_sums_update');
        
	}


/* 
Please copy this section into ../application/modules/admin/config/form_validation.php

	'fin_sum/create' => array(
			array(
            	'field'		 => 'year_num',
            	'label'		 => 'Tahun',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'month_num',
            	'label'		 => 'Bulan',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'week_num',
            	'label'		 => 'Minggu Ke',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'qty_person',
            	'label'		 => 'Jumlah Jemaat',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'amount',
            	'label'		 => 'Pemasukkan',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'status_data',
            	'label'		 => 'Status Data',
            	'rules'		 => 'trim|required',
        	),
        ),


	'fin_sum/update' => array(
			array(
            	'field'		 => 'year_num',
            	'label'		 => 'Tahun',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'month_num',
            	'label'		 => 'Bulan',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'week_num',
            	'label'		 => 'Minggu Ke',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'qty_person',
            	'label'		 => 'Jumlah Jemaat',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'amount',
            	'label'		 => 'Pemasukkan',
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
/* End of file Fin_sum.php */
/* Location: ./application/controllers/Fin_sum.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Custom Codeigniter CRUD Generator 2020-02-04 15:48:06 */