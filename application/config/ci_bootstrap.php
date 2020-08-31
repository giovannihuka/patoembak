<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| CI Bootstrap 3 Configuration
| -------------------------------------------------------------------------
| This file lets you define default values to be passed into views 
| when calling MY_Controller's render() function. 
| 
| See example and detailed explanation from:
| 	/application/config/ci_bootstrap_example.php
*/

$config['ci_bootstrap'] = array(

	// Site name
	'site_name' => 'GBI Patoembak',

	// Default page title prefix
	'page_title_prefix' => '',

	// Default page title
	'page_title' => 'GBI Patoembak',

	// Default meta data
	'meta_data'	=> array(
		'author'		=> 'Giovanni H. Huka',
		'description'	=> '',
		'keywords'		=> ''
	),

	// Default scripts to embed at page head or end
	'scripts' => array(
		'head'	=> array(
			'assets/dist/admin/scroll_up.js',
		),
		'foot'	=> array(
			'assets/dist/frontend/lib.min.js',
			'assets/dist/frontend/app.min.js',
		),
	),

	// Default stylesheets to embed at page head
	'stylesheets' => array(
		'screen' => array(
			'assets/css/my_style.css',
			'assets/dist/frontend/lib.min.css',
			'assets/dist/frontend/app.min.css',
			'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic',
			'assets/css/w3.css',
		)
	),

	// Default CSS class for <body> tag
	'body_class' => 'skin-blue',
	
	// Multilingual settings
	'languages' => array(
		// 'default'		=> 'en',
		// 'autoload'		=> array('general'),
		// 'available'		=> array(
		// 	'en' => array(
		// 		'label'	=> 'English',
		// 		'value'	=> 'english'
		// 	),
		// 	'id' => array(
		// 		'label'	=> 'Indonesian',
		// 		'value'	=> 'indonesian'
		// 	),
		// 	'zh' => array(
		// 		'label'	=> '繁體中文',
		// 		'value'	=> 'traditional-chinese'
		// 	),
		// 	'cn' => array(
		// 		'label'	=> '简体中文',
		// 		'value'	=> 'simplified-chinese'
		// 	),
		// 	'es' => array(
		// 		'label'	=> 'Español',
		// 		'value' => 'spanish'
		// 	)
		// )
	),

	// Google Analytics User ID
	'ga_id' => '',

	// Menu items
	'menu' => array(
		'home' => array(
			'name'		=> 'Home',
			'url'		=> '',
		),
		// 'contract' => array(
		// 	'name'		=> 'Contract',
		// 	'url'		=> 'contract',
		// ),
		// 'map' => array(
		// 	'name'		=> 'Cabang',
		// 	'url'		=> 'map',
		// ),
		// 'video' => array(
		// 	'name'		=> 'Video',
		// 	'url'		=> 'video_list',
		// ),
		'ytube' => array(
			'name'		=> 'YouTube Channel',
			'url'		=> 'https://www.youtube.com/channel/UCIDUq5BHeiFc1tRfsRr5efQ',
			'target'	=> '_blank',
		),
		'activity' => array(
			'name'		=> 'Kegiatan',
			'url'		=> 'activity',
		),
		// 'test' => array(
		// 	'name'		=> 'Test Page',
		// 	'url'		=> 'test',
		// ),
		'admin' => array(
			'name'		=> 'Admin',
			'url'		=> 'admin',
			'target'	=> '_blank',
			// 'children'	=> array(
			// 	'detik.com'		=> 'Detik.com',
			// 	'url'		=> 'https://detik.com',
			// ),
		),
	),

	// Login page
	'login_url' => 'login',

	// Restricted pages
	'page_auth' => array(
		'admin' => array('internal','penjadwalan'),
		'activity' => array('internal','penjadwalan'),
	),

	// Email config
	'email' => array(
		'from_email'		=> '',
		'from_name'			=> '',
		'subject_prefix'	=> '',
		
		// Mailgun HTTP API
		'mailgun_api'		=> array(
			'domain'			=> '',
			'private_api_key'	=> ''
		),
	),

	// Debug tools
	'debug' => array(
		'view_data'	=> FALSE,
		'profiler'	=> FALSE
	),
);

/*
| -------------------------------------------------------------------------
| Override values from /application/config/config.php
| -------------------------------------------------------------------------
*/
$config['sess_cookie_name'] = 'gereja_session_frontend';