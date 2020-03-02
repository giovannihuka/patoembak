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
			'assets/dist/admin/sidemenu_stay.js',
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
		'contract' => array(
			'name'		=> 'Gereja',
			'url'		=> 'contract',
			'icon'		=> 'fa fa-building-o',
			'children'	=> array(
				'Informasi Data Gereja' 	=> 'contract',
				'Registrasi Gereja'	=> 'contract/create',
				'Lokasi Gereja' 	=> 'map',
			)
		),
		'activitie' => array(
			'name'		=> 'Kegiatan Gereja',
			'url'		=> 'activitie',
			'icon'		=> 'fa fa-calendar-check-o',
			'children'	=> array(
				'Jadwal Kegiatan'	=> 'activitie',
				'Jumlah Kehadiran'	=> 'attendance',
			)
		),
		'individual' => array(
			'name'		=> 'Pendataan Jemaat',
			'url'		=> 'individual',
			'icon'		=> 'fa fa-address-book-o',
			'children'	=> array(
				'Data per Individu' => 'individual',
				'Data per Keluarga'	=> 'familie',
				// 'Kirim Email'		=> 'individual/send_email',
			)
		),	
		'accounting' => array(
			'name'		=> 'Keuangan',
			'url'		=> 'accounting',
			'icon'		=> 'fa fa-money',
			'children'	=> array(
				'Kategori'				=> 'ref_acccategorie',
				'Transaksi Keuangan' 	=> 'accounting',
				'Laporan Keuangan'		=> 'vw_accreport',
			),
		),
		'configuration'=> array(
			'name'		=> 'Konfigurasi Sistem',
			'url'		=> 'admin',
			'icon'		=> 'fa fa-cog',
			'children'	=> array(
				'Peran Dalam Keluarga'	=> 'ref_role',
				'Status Pernikahan'		=> 'ref_marriage',
				'Referensi Kegiatan'	=> 'ref_activitie',
				'Jenis Kelamin'			=> 'ref_gender',
				'Referensi Jabatan'		=> 'ref_rank',
				'Referensi Gembala'		=> 'pastor',
			)	
		),
		'blog' => array(
			'name'		=> 'Blog',
			'url'		=> 'blog',
			'icon'		=> 'fa fa-newspaper-o',
			'children'	=> array(
				'Pastor Message'	=> 'video',
				'Firman Tuhan'		=> 'scripture',
			)
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
		'activitie'					=> array('penjadwalan','admin'),
		'pastor'					=> array('admin'),
		'ref_gender'				=> array('admin'),
		'pastor'					=> array('admin'),
		'contract'					=> array('admin'),
		'contract/create'			=> array('admin'),
		'pastor'					=> array('admin'),
		'individual'				=> array('admin'),
		'individual/create'			=> array('admin'),
		'individual/send_email'		=> array('admin'),
		'ref_rank'					=> array('admin'),
		'familie'					=> array('admin'),
		'familie/create'			=> array('admin'),
		'ref_acccategorie'			=> array('admin'),
		'accounting'				=> array('admin'),
		'account'					=> array('admin'),
		'account/create'			=> array('admin'),
		'ref_role'					=> array('admin'),
		'ref_marriage'				=> array('admin'),
	),

	// AdminLTE settings
	'adminlte' => array(
		'body_class' => array(
			'webmaster'	=> 'skin-red',
			'admin'		=> 'skin-blue',
			'manager'	=> 'skin-black',
			'staff'		=> 'skin-blue',
			'penjadwalan'	=> 'skin-blue',
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
