<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// Load library phpspreadsheet
require_once('./excel/vendor/autoload.php');

// use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// use PhpOffice\PhpSpreadsheet\Shared\File::setUseUploadTempDirectory(true);
// End load library phpspreadsheet

class Attendance extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Attendance_model');
        $this->load->library('form_builder');
        $this->load->model('common_model','common_ref');        
	    $this->load->library('datatables');
    }

    private $script = array(
        'assets/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js',
        'assets/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js',
        'assets/dist/admin/attendance.js',
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
        $this->mPageTitle = 'Informasi Info Kehadiran'; 
        $this->render('attendance/attendances_list');
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
        //     echo $this->Attendance_model->json($contractid);
        // }
        // else
        // {
            echo $this->Attendance_model->json();
        // }

        /* ------------------------------------------------- */

    }

    public function read($id)
    {
        $form = $this->form_builder->create_form();

        $row = $this->Attendance_model->get_by_id($id);
            
            if ($row)
            {

                $data = array (

					'activity_date' => $row->activity_date,
					'ref_activityid' => $row->ref_activityid,
					'qty' => $row->qty,

                );
            }

        $this->mViewData['attendance'] = $data;
        $this->mPageTitle = 'Info Kehadiran';
        $this->mViewData['form'] = $form;
        $this->render('attendance/attendances_read');
    }

    public function delete($id) 
    {
        $row = $this->Attendance_model->get_by_id($id);

        if ($row) {
            $this->Attendance_model->set_primary_key('id');
            $this->Attendance_model->delete($id);
            $this->Attendance_model->set_primary_key('id');
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/attendance'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/attendance'));
        }
    }


    public function excel()
    {
        $spreadsheet = new Spreadsheet();

        $filename = 'Product_Normalization_'.date('YmdHis');

        $rowhead = 1;
        $columnhead = 1;

        // Set document properties
        $spreadsheet->getProperties()->setCreator('FMCG Application')
        ->setLastModifiedBy('Giovanni - Creator')
        ->setTitle('Office 2007 XSLX Document')
        ->setSubject('Office 2007 XSLX Document')
        ->setDescription('Excel report generated by FMCG Application')
        ->setKeywords('office 2007 openxml php')
        ->setCategory('Excel report');

        // Add some data
        $spreadsheet->setActiveSheetIndex(0)
        ->setCellValueByColumnAndRow($columnhead++,$rowhead,'Tgl. Kegiatan')
        ->setCellValueByColumnAndRow($columnhead++,$rowhead,'Nama Kegiatan')
        ->setCellValueByColumnAndRow($columnhead++,$rowhead,'Jumlah Yang Hadir');

            $rowbody = 2;

            $nourut = 1;

        foreach ($this->Attendance_model->get_all() as $data) {
            # code...
            $columnbody = 1;


            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValueByColumnAndRow($columnbody++,$rowbody,$data->activity_date)
            ->setCellValueByColumnAndRow($columnbody++,$rowbody,$data->activity_name)
            ->setCellValueByColumnAndRow($columnbody++,$rowbody,$data->qty);

            $rowbody++;
            $nourut++;
        }

        // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('PRODUCT_LIST_'.date('Ymd'));

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);

        // // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
        header('Cache-Control: max-age=0');
        // // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // // If you're serving to IE over SSL, then the following may be needed
        // header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        // header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        // header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        // header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }

    public function texcel()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Hello World !');

        // $writer = new Xlsx($spreadsheet);
        // $writer->save('hello world.xlsx');

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }

 //    public function excel()
 //    {
 //        $this->load->helper('exportexcel');
 //        $namaFile = "attendances.xls";
 //        $judul = "attendances";
 //        $tablehead = 0;
 //        $tablebody = 1;
 //        $nourut = 1;
 //        //penulisan header
 //        header("Pragma: public");
 //        header("Expires: 0");
 //        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
 //        header("Content-Type: application/force-download");
 //        header("Content-Type: application/octet-stream");
 //        header("Content-Type: application/download");
 //        header("Content-Disposition: attachment;filename=" . $namaFile . "");
 //        header("Content-Transfer-Encoding: binary ");

 //        xlsBOF();

 //        $kolomhead = 0;
 //        xlsWriteLabel($tablehead, $kolomhead++, "No");
	// xlsWriteLabel($tablehead, $kolomhead++, "Activity Date");
	// xlsWriteLabel($tablehead, $kolomhead++, "Ref Activityid");
	// xlsWriteLabel($tablehead, $kolomhead++, "Qty");

	// foreach ($this->Attendance_model->get_all() as $data) {
 //            $kolombody = 0;

 //            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
 //            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	//     xlsWriteLabel($tablebody, $kolombody++, $data->activity_date);
	//     xlsWriteNumber($tablebody, $kolombody++, $data->ref_activityid);
	//     xlsWriteNumber($tablebody, $kolombody++, $data->qty);

	//     $tablebody++;
 //            $nourut++;
 //        }

 //        xlsEOF();
 //        exit();
 //    }

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
			$ref_activityid = $this->input->post('ref_activityid');
			$qty = $this->input->post('qty');

    		$data = $this->Attendance_model->
        	insert(array
                (
					'activity_date' => $activity_date,
					'ref_activityid' => $ref_activityid,
					'qty' => $qty,
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

        $this->mViewData['attendance'] = $this->Attendance_model->get_all();
        $this->mViewData['activity_list'] = $this->common_ref->activity_list();
        $this->mPageTitle = 'Registrasi Info Kehadiran';
        $this->mViewData['form'] = $form;
        $this->render('attendance/attendances_form');
        
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
			$ref_activityid = $this->input->post('ref_activityid');
			$qty = $this->input->post('qty');

            $this->Attendance_model->set_primary_key('id');

            $data = $this->Attendance_model->
            update($id,
                array
                (
					'activity_date' => $activity_date,
					'ref_activityid' => $ref_activityid,
					'qty' => $qty,
				)
    );

    $this->Attendance_model->set_primary_key('id');

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

    $row = $this->Attendance_model->get_by_id($id);

    if ($row)
    {

        $data = array (
					'activity_date' => $row->activity_date,
					'ref_activityid' => $row->ref_activityid,
					'qty' => $row->qty,
					'button' => 'Update',
                );
            }

        }

        $this->mViewData['attendance'] = $data;
        $this->mViewData['activity_list'] = $this->common_ref->activity_list();
        $this->mViewData['status_list'] = $this->common_ref->status_list();
        $this->mPageTitle = 'Ubah Info Kehadiran';
        $this->mViewData['form'] = $form;
        $this->render('attendance/attendances_update');
        
	}


/* 
Please copy this section into ../application/modules/admin/config/form_validation.php

	'attendance/create' => array(
			array(
            	'field'		 => 'activity_date',
            	'label'		 => 'Tgl. Kegiatan',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'ref_activityid',
            	'label'		 => 'Nama Kegiatan',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'qty',
            	'label'		 => 'Jumlah Yg Hadir',
            	'rules'		 => 'trim|required|numeric',
        	),
        ),


	'attendance/update' => array(
			array(
            	'field'		 => 'activity_date',
            	'label'		 => 'Tgl. Kegiatan',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'ref_activityid',
            	'label'		 => 'Nama Kegiatan',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'qty',
            	'label'		 => 'Jumlah Yg Hadir',
            	'rules'		 => 'trim|required|numeric',
        	),
        ),

*/

}
/* End of file Attendance.php */
/* Location: ./application/controllers/Attendance.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Custom Codeigniter CRUD Generator 2019-10-17 16:53:48 */