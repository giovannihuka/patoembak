<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Video extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Video_model');
        $this->load->library('form_builder');
        $this->load->model('common_model','common_ref');        
	    $this->load->library('datatables');
    }

    private $script = array(
        'assets/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js',
        'assets/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js',
        'assets/dist/admin/video.js',
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

    private $ckeditor_script = array(
        'assets/ckeditor/ckeditor.js',
        'assets/ckeditor/config.js',
    );

    public function index()
    {
        $this->add_script($this->script,FALSE,'foot');
        $this->add_stylesheet($this->stylesheet,FALSE,'screen');

        /* Testing youtube video */
        // $this->mViewData['movie'] = $this->common_ref->youtube_id('https://www.youtube.com/watch?v=I752ofYu7ag');
        /* --------------------- */
        
        $this->mPageTitle = 'Informasi Video Gallery'; 
        $this->render('video/videos_list');
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
        //     echo $this->Video_model->json($contractid);
        // }
        // else
        // {
            echo $this->Video_model->json();
        // }

        /* ------------------------------------------------- */

    }

    public function read($id)
    {
        $form = $this->form_builder->create_form();
        $this->add_script($this->ckeditor_script,FALSE,'head');

        $row = $this->Video_model->get_by_id($id);
            
            if ($row)
            {

                $data = array (

					'video_title' => $row->video_title,
					'video_desc' => $row->video_desc,
					'video_url' => $row->video_url,
                    'sequence_num' => $row->sequence_num,
					'publish_date' => $row->publish_date,
					'end_date' => $row->end_date,
                    'sequence_num' => $row->sequence_num,
					'status_data' => $row->status_data,

                );
            }

        $this->mViewData['video'] = $data;
        $this->mPageTitle = 'Video Gallery';
        $this->mViewData['form'] = $form;
        $this->render('video/videos_read');
    }

    public function delete($id) 
    {
        $row = $this->Video_model->get_by_id($id);

        if ($row) {
            $this->Video_model->set_primary_key('id');
            $this->Video_model->delete($id);
            $this->Video_model->set_primary_key('id');
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/video'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/video'));
        }
    }

    public function create()
    {
        $form = $this->form_builder->create_form('',false,array('autocomplete'=>'on'));

        $this->add_script($this->datepicker_script,FALSE,'foot');
        $this->add_script($this->ckeditor_script,FALSE,'head');
        $this->add_stylesheet($this->stylesheet,FALSE,'screen');

        $userid = $this->ion_auth->get_user_id();
        $username = $this->ion_auth->get_user_name();
        $contractid = $this->ion_auth->get_contract_id();
        $usergroup = $this->ion_auth->get_users_groups()->row()->name;
        
        if ($form->validate())
        {
			$video_title = $this->input->post('video_title');
			$video_desc = $this->input->post('video_desc');
			$video_url = $this->input->post('video_url');
			$publish_date = $this->input->post('publish_date');
			$end_date = $this->input->post('end_date');
            $sequence_num = $this->input->post('sequence_num');

    		$data = $this->Video_model->
        	insert(array
                (
					'video_title' => $video_title,
					'video_desc' => empty($video_desc)? NULL:$video_desc,
					'video_url' => $video_url,
					'publish_date' => empty($publish_date)? NULL:$publish_date,
					'end_date' => empty($end_date)? NULL:$end_date,
                    'sequence_num' => empty($sequence_num)? 999:$sequence_num,
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

        $this->mViewData['video'] = $this->Video_model->get_all();
        $this->mPageTitle = 'Registrasi Video Gallery';
        $this->mViewData['form'] = $form;
        $this->render('video/videos_form');
        
	}

    public function update_seq($id)
    {
        $this->Video_model->set_primary_key('id');

        $sequence_num = $this->input->post('row_seq');

        $data = $this->Video_model->
        update($id,
            array(
                'sequence_num' => $sequence_num,
            )
        );

        refresh();
    }

    public function update($id)
    {
        $form = $this->form_builder->create_form('',false,array('autocomplete'=>'off'));

        $this->add_script($this->datepicker_script,FALSE,'foot');
        $this->add_script($this->ckeditor_script,FALSE,'head');
        $this->add_stylesheet($this->stylesheet,FALSE,'screen');

        $userid = $this->ion_auth->get_user_id();
        $username = $this->ion_auth->get_user_name();
        $contractid = $this->ion_auth->get_contract_id();
        $usergroup = $this->ion_auth->get_users_groups()->row()->name;

        if ($form->validate())
        {
			$video_title = $this->input->post('video_title');
			$video_desc = $this->input->post('video_desc');
			$video_url = $this->input->post('video_url');
			$publish_date = $this->input->post('publish_date');
			$end_date = $this->input->post('end_date');
            $sequence_num = $this->input->post('sequence_num');
			$status_data = $this->input->post('status_data');

            $this->Video_model->set_primary_key('id');

            $data = $this->Video_model->
            update($id,
                array
                (
					'video_title' => $video_title,
                    'video_desc' => empty($video_desc)? NULL:$video_desc,
                    'video_url' => $video_url,
                    'publish_date' => empty($publish_date)? NULL:$publish_date,
                    'end_date' => empty($end_date)? NULL:$end_date,
                    'sequence_num' => empty($sequence_num)? 999:$sequence_num,
					'status_data' => $status_data,
					'update_userid' => $userid,
					'update_time' => time(),
				)
    );

    $this->Video_model->set_primary_key('id');

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

    $row = $this->Video_model->get_by_id($id);

    if ($row)
    {

        $data = array (
					'video_title' => $row->video_title,
					'video_desc' => $row->video_desc,
					'video_url' => $row->video_url,
					'publish_date' => $row->publish_date,
					'end_date' => $row->end_date,
                    'sequence_num' => $row->sequence_num,
					'status_data' => $row->status_data,
					'button' => 'Update',
                );
            }

        }

        $this->mViewData['video'] = $data;
        $this->mViewData['status_list'] = $this->common_ref->status_list();
        $this->mPageTitle = 'Ubah Video Gallery';
        $this->mViewData['form'] = $form;
        $this->render('video/videos_update');
        
	}


/* 
Please copy this section into ../application/modules/admin/config/form_validation.php

	'video/create' => array(
			array(
            	'field'		 => 'video_title',
            	'label'		 => 'Judul',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'video_desc',
            	'label'		 => 'Deskripsi',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'video_url',
            	'label'		 => 'URL',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'publish_date',
            	'label'		 => 'Tgl. Publikasi',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'end_date',
            	'label'		 => 'Tgl. Akhir Publikasi',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'status_data',
            	'label'		 => 'Status Data',
            	'rules'		 => 'trim|required',
        	),
        ),


	'video/update' => array(
			array(
            	'field'		 => 'video_title',
            	'label'		 => 'Judul',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'video_desc',
            	'label'		 => 'Deskripsi',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'video_url',
            	'label'		 => 'URL',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'publish_date',
            	'label'		 => 'Tgl. Publikasi',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'end_date',
            	'label'		 => 'Tgl. Akhir Publikasi',
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
/* End of file Video.php */
/* Location: ./application/controllers/Video.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Custom Codeigniter CRUD Generator 2018-08-15 11:20:06 */