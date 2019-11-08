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
	'page_title' => 'GBI Patoembak [ADMIN]',

	// Default meta data
	'meta_data'	=> array(
		'author'		=> 'Giovanni',
		'description'	=> '',
		'keywords'		=> ''
	),
	
	// Default scripts to embed at page head or end
	'scripts' => array(
		'head'	=> array(
			'assets/dist/admin/adminlte.min.js',
			'assets/dist/admin/lib.min.js',
			'assets/dist/admin/app.min.js',
		),
		'foot'	=> array(
			// 'assets/bootstrap/js/bootstrap.min.js',
		),
	),

	// Default stylesheets to embed at page head
	'stylesheets' => array(
		'screen' => array(
			'assets/dist/admin/adminlte.min.css',
			'assets/css/my_style.css',
			'assets/dist/admin/lib.min.css',
			'assets/dist/admin/app.min.css',
			'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic',
			// 'assets/css/w3.css',
		)
	),

	// Default CSS class for <body> tag
	'body_class' => '',
	
	// Multilingual settings
	'languages' => array(
	),

	// Menu items
	'menu' => array(
		'home' => array(
			'name'		=> 'Home',
			'url'		=> '',
			'icon'		=> 'fa fa-home',
		),
		'user' => array(
			'name'		=> 'Users',
			'url'		=> 'user',
			'icon'		=> 'fa fa-users',
			'children'  => array(
				'List'			=> 'user',
				'Create'		=> 'user/create',
				'User Groups'	=> 'user/group',
			)
		),
		'panel' => array(
			'name'		=> 'Admin Panel',
			'url'		=> 'panel',
			'icon'		=> 'fa fa-cog',
			'children'  => array(
				'Admin Users'			=> 'panel/admin_user',
				'Create Admin User'		=> 'panel/admin_user_create',
				'Admin User Groups'		=> 'panel/admin_user_group',
			)
		),
		'rank' => array(
			'name'		=> 'Jabatan',
			'url'		=> 'ref_rank',
			'icon'		=> 'fa fa-exchange',
		),
		'pastor' => array(
			'name'		=> 'Gembala',
			'url'		=> 'pastor',
			'icon'		=> 'fa fa-child',
		),
		'gender' => array(
			'name'		=> 'Jenis Kelamin',
			'url'		=> 'ref_gender',
			'icon'		=> 'fa fa-venus-mars',
		),
		'contract' => array(
			'name'		=> 'Gereja',
			'url'		=> 'contract',
			'icon'		=> 'fa fa-building-o',
			'children'	=> array(
				'Informasi Data Gereja' 	=> 'contract',
				'Registrasi Gereja'	=> 'contract/create',
			)
		),
		'map' => array(
			'name'		=> 'Peta Lokasi',
			'url'		=> 'map',
			'icon'		=> 'fa fa-map-o',
		),
		'activity' => array(
			'name'		=> 'Agenda Kegiatan',
			'url'		=> 'activitie',
			'icon'		=> 'fa fa-calendar-check-o',
		),
		'individual' => array(
			'name'		=> 'Informasi Individu',
			'url'		=> 'individual',
			'icon'		=> 'fa fa-address-book-o',
			'children'	=> array(
				'Informasi Data Individu' 	=> 'individual',
				'Registrasi Individu'	=> 'individual/create',
				'Kirim Email'		=> 'individual/send_email',
			)
		),	
		'familie' => array(
			'name'		=> 'Informasi Keluarga',
			'url'		=> 'familie',
			'icon'		=> 'fa fa-address-card-o',
			'children'	=> array(
				'Data Keluarga' 	=> 'familie',
				'Registrasi Keluarga'	=> 'familie/create',
			)
		),	
		'accounting' => array(
			'name'		=> 'Keuangan',
			'url'		=> 'accounting',
			'icon'		=> 'fa fa-money',
			'children'	=> array(
				'Kategori'				=> 'ref_acccategorie',
				'Transaksi Keuangan' 	=> 'accounting',
			),
		),
		'admin'=> array(
			'name'		=> 'Konfigurasi Sistem',
			'url'		=> 'admin',
			'icon'		=> 'fa fa-cog',
			'children'	=> array(
				'Peran Dalam Keluarga'	=> 'ref_role',
				'Status Pernikahan'		=> 'ref_marriage',
				'Referensi Kegiatan'	=> 'ref_activitie',
				'Informasi Jumlah Jemaat'	=> 'attendance',
			)	
		),
		'blog' => array(
			'name'		=> 'Blog',
			'url'		=> 'blog',
			'icon'		=> 'fa fa-newspaper-o',
		),	
		'video' => array(
			'name'		=> 'Video',
			'url'		=> 'video',
			'icon'		=> 'fa fa-film',
		),	
		'scripture' => array(
			'name'		=> 'Firman Tuhan',
			'url'		=> 'scripture',
			'icon'		=> 'fa fa-book',
		),	
		'logview' => array(
			'name'		=> 'Log Viewer',
			'url'		=> 'log',
			'icon'		=> 'fa fa-heartbeat',
		),
		'acc_account' => array(
			'name'		=> 'Chart of Account',
			'url'		=> 'account',
			'icon'		=> 'fa fa-money',
			'children'	=> array(
				'List of COA'	=> 'account',
				'Add COA'		=> 'account/create',
			),
		),
		'util' => array(
			'name'		=> 'Utilities',
			'url'		=> 'util',
			'icon'		=> 'fa fa-cogs',
			'children'  => array(
				'Database Versions'		=> 'util/list_db',
			)
		),
		'logout' => array(
			'name'		=> 'Sign Out',
			'url'		=> 'panel/logout',
			'icon'		=> 'fa fa-sign-out',
		)
	),

	// Login page
	'login_url' => 'admin/login',

	// Restricted pages
	'page_auth' => array(
		'user'						=> array('webmaster', 'admin', 'manager'),
		'user/create'				=> array('webmaster', 'admin', 'manager'),
		'user/group'				=> array('webmaster', 'admin', 'manager'),
		'panel'						=> array('webmaster'),
		'panel/admin_user'			=> array('webmaster'),
		'panel/admin_user_create'	=> array('webmaster'),
		'panel/admin_user_group'	=> array('webmaster'),
		'util'						=> array('webmaster'),
		'util/list_db'				=> array('webmaster'),
		'util/backup_db'			=> array('webmaster'),
		'util/restore_db'			=> array('webmaster'),
		'util/remove_db'			=> array('webmaster'),
		'log'						=> array('webmaster', 'admin'),
		'member/send_email'			=> array('webmaster', 'admin'),
		'ref_recurrence'			=> array('webmaster', 'admin'),
		'admin/ref_role'			=> array('webmaster', 'admin'),
		'admin/ref_marriage'		=> array('webmaster', 'admin'),
		
	),

	// AdminLTE settings
	'adminlte' => array(
		'body_class' => array(
			'webmaster'	=> 'skin-red',
			'admin'		=> 'skin-blue',
			'manager'	=> 'skin-black',
			'staff'		=> 'skin-blue',
		)
	),

	// Useful links to display at bottom of sidemenu
	'useful_links' => array(
		// array(
		// 	'auth'		=> array('webmaster', 'admin', 'manager', 'staff'),
		// 	'name'		=> 'Frontend Website',
		// 	'url'		=> '',
		// 	'target'	=> '_blank',
		// 	'color'		=> 'text-aqua'
		// ),
		// array(
		// 	'auth'		=> array('webmaster', 'admin'),
		// 	'name'		=> 'API Site',
		// 	'url'		=> 'api',
		// 	'target'	=> '_blank',
		// 	'color'		=> 'text-orange'
		// ),
		// array(
		// 	'auth'		=> array('webmaster', 'admin', 'manager', 'staff'),
		// 	'name'		=> 'Github Repo',
		// 	'url'		=> CI_BOOTSTRAP_REPO,
		// 	'target'	=> '_blank',
		// 	'color'		=> 'text-green'
		// ),
		array(
			'auth'		=> array('webmaster', 'admin'),
			'name'		=> 'Set Berulang',
			'url'		=> 'admin/ref_recurrence',
			'target'	=> '',
			'color'		=> 'text-red'
		),
		array(
			'auth'		=> array('webmaster', 'admin'),
			'name'		=> 'Status Menikah',
			'url'		=> 'admin/ref_marriage',
			'target'	=> '',
			'color'		=> 'text-yellow'
		),
		array(
			'auth'		=> array('webmaster', 'admin'),
			'name'		=> 'Ref Tipe COA',
			'url'		=> 'admin/ref_charttype',
			'target'	=> '',
			'color'		=> 'text-blue'
		),
		array(
			'auth'		=> array('webmaster', 'admin'),
			'name'		=> 'Hubungan dalam Keluarga',
			'url'		=> 'admin/ref_role',
			'target'	=> '',
			'color'		=> 'text-green'
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
$config['sess_cookie_name'] = 'gereja_session_backend';
