<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home page
 */
class Activity extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->library('form_builder');
        $this->load->model('common_model','common_ref'); 
    }

    private $script = array(
        // 'assets/dist/admin/adminlte.min.js',
        'assets/dist/admin/scroll_up.js',
    ); 

    private $stylesheet = array(
        'assets/dist/admin/adminlte.min.css',
        // 'assets/css/my_style.css',
    );

	public function index()
	{
        // $this->add_script($this->script,FALSE,'head');
        
        // $this->add_script($this->script,FALSE,'foot');
        $this->add_stylesheet($this->stylesheet,FALSE,'screen');
        $this->mViewData['schedule_list'] = $this->common_ref->schedule_list('login');
		$this->render('activity/activity_list', 'full_width');
	}
}
