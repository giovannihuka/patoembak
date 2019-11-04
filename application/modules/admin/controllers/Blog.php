<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Blog_model');
        $this->load->library('form_builder');
        $this->load->model('common_model','common_ref');        
	    $this->load->library('datatables');
    }

    private $script = array(
        'assets/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js',
        'assets/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js',
        'assets/dist/admin/blog.js',
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

    public function index()
    {
        $this->add_script($this->script,FALSE,'foot');
        $this->add_stylesheet($this->stylesheet,FALSE,'screen');
        $this->mPageTitle = 'Informasi Blog'; 
        $this->render('blog/blogs_list');
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
        //     echo $this->Blog_model->json($contractid);
        // }
        // else
        // {
            echo $this->Blog_model->json();
        // }

        /* ------------------------------------------------- */

    }

    public function read($id)
    {
        $form = $this->form_builder->create_form();

        $row = $this->Blog_model->get_by_id($id);
            
            if ($row)
            {

                $data = array (

					'blog_category' => $row->blog_category,
					'title' => $row->title,
					'content_text' => $row->content_text,
					'publish_date' => $row->publish_date,
					'end_date' => $row->end_date,

                );
            }

        $this->mViewData['blog'] = $data;
        $this->mPageTitle = 'Blogging';
        $this->mViewData['form'] = $form;
        $this->render('blog/blogs_read');
    }

    public function delete($id) 
    {
        $row = $this->Blog_model->get_by_id($id);

        if ($row) {
            $this->Blog_model->set_primary_key('id');
            $this->Blog_model->delete($id);
            $this->Blog_model->set_primary_key('id');
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/blog'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/blog'));
        }
    }

    public function create()
    {
        $form = $this->form_builder->create_form('',false,array('autocomplete'=>'off'));

        $this->add_script($this->datepicker_script,FALSE,'foot');
        $this->add_script($this->phoneformat_script,FALSE,'foot');
        $this->add_stylesheet($this->stylesheet,FALSE,'screen');

        $userid = $this->ion_auth->get_user_id();
        $username = $this->ion_auth->get_user_name();
        $contractid = $this->ion_auth->get_contract_id();
        $usergroup = $this->ion_auth->get_users_groups()->row()->name;
        
        if ($form->validate())
        {
			$blog_category = $this->input->post('blog_category');
			$title = $this->input->post('title');
			$content_text = $this->input->post('content_text');
			$publish_date = $this->input->post('publish_date');
			$end_date = $this->input->post('end_date');

    		$data = $this->Blog_model->
        	insert(array
                (
					'blog_category' => $blog_category,
					'title' => $title,
					'content_text' => $content_text,
					'publish_date' => $publish_date,
					'end_date' => $end_date,
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

        $this->mViewData['blog'] = $this->Blog_model->get_all();
        $this->mPageTitle = 'Registrasi Blogging';
        $this->mViewData['form'] = $form;
        $this->render('blog/blogs_form');
        
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
        $usergroup = $this->ion_auth->get_users_groups()->row()->name;

        if ($form->validate())
        {
			$blog_category = $this->input->post('blog_category');
			$title = $this->input->post('title');
			$content_text = $this->input->post('content_text');
			$publish_date = $this->input->post('publish_date');
			$end_date = $this->input->post('end_date');

            $this->Blog_model->set_primary_key('id');

            $data = $this->Blog_model->
            update($id,
                array
                (
					'blog_category' => $blog_category,
					'title' => $title,
					'content_text' => $content_text,
					'publish_date' => $publish_date,
					'end_date' => $end_date,
					'update_userid' => $userid,
					'update_time' => time(),
				)
    );

    $this->Blog_model->set_primary_key('id');

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

    $row = $this->Blog_model->get_by_id($id);

    if ($row)
    {

        $data = array (
					'blog_category' => $row->blog_category,
					'title' => $row->title,
					'content_text' => $row->content_text,
					'publish_date' => $row->publish_date,
					'end_date' => $row->end_date,
					'button' => 'Update',
                );
            }

        }

        $this->mViewData['blog'] = $data;
        $this->mPageTitle = 'Ubah Blogging';
        $this->mViewData['form'] = $form;
        $this->render('blog/blogs_update');
        
	}


/* 
Please copy this section into ../application/modules/admin/config/form_validation.php

	'blog/create' => array(
			array(
            	'field'		 => 'blog_category',
            	'label'		 => 'Kategori Blog',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'title',
            	'label'		 => 'Judul',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'content_text',
            	'label'		 => 'Isi Blog',
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
        ),


	'blog/update' => array(
			array(
            	'field'		 => 'blog_category',
            	'label'		 => 'Kategori Blog',
            	'rules'		 => 'trim|required|numeric',
        	),
        	array(
            	'field'		 => 'title',
            	'label'		 => 'Judul',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'content_text',
            	'label'		 => 'Isi Blog',
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
        ),

*/

}
/* End of file Blog.php */
/* Location: ./application/controllers/Blog.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Custom Codeigniter CRUD Generator 2018-10-17 10:15:45 */