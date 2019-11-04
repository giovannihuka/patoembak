<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home page
 */
class Video_list extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Video_list_model','videos');
		$this->load->library('form_builder');
	}	

    private $script = array(
        // 'assets/dist/admin/adminlte.min.js',
        'assets/dist/admin/scroll_up.js',
    ); 

	public function index()
	{
		$form = $this->form_builder->create_form();
		$this->add_script($this->script,FALSE,'head');
		$this->mPageTitle = 'Video Gallery'; 
		$this->mViewData['form'] = $form;
		$this->mViewData['videos'] = $this->videos->get_all();
		$this->render('video_list/video_list', 'full_width');
	}

	public function play_movie($id)
	{
		$form = $this->form_builder->create_form();
		$this->add_script($this->script,FALSE,'head');

		$row = $this->videos->get_by_id($id);

		if ($row)
		{
			$data = array(
				'video_title' => $row->video_title,
				'video_desc' => $row->video_desc,
				'video_url' => $row->video_url,
			);
		}

		$this->mPageTitle = 'Video Gallery'; 
		$this->mViewData['form'] = $form;
		$this->mViewData['videos'] = $data;
		$this->render('video_list/video_play', 'full_width');
	}
}