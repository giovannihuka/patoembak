<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home page
 */
class Test extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->library('form_builder');
        $this->load->model('common_model','common_ref'); 
    }

    private $script = array(
        // 'assets/dist/admin/adminlte.min.js',
        // 'assets/dist/admin/scroll_up.js',
    ); 

    private $stylesheet = array(
        'assets/dist/admin/adminlte.min.css',
        // 'assets/css/my_style.css',
    );

	public function index()
	{
        // $this->add_script($this->script,FALSE,'head');
        $this->add_script($this->script,FALSE,'foot');
        $this->add_stylesheet($this->stylesheet,FALSE,'screen');
        // $this->mViewData['bday_list'] = $this->common_ref->bday_list();
        // $this->mViewData['scripture'] = $this->common_ref->scripture_text();
		$this->render('test', 'full_width');
	}
}
