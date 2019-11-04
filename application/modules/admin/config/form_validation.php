<?php

/**
 * Config file for form validation
 * Reference: http://www.codeigniter.com/user_guide/libraries/form_validation.html
 * (Under section "Creating Sets of Rules")
 */

$config = array(

	// Admin User Login
	'login/index' => array(
		array(
			'field'		=> 'username',
			'label'		=> 'Username',
			'rules'		=> 'required',
		),
		array(
			'field'		=> 'password',
			'label'		=> 'Password',
			'rules'		=> 'required',
		),
	),

	// Create User
	'user/create' => array(
		array(
			'field'		=> 'first_name',
			'label'		=> 'First Name',
			'rules'		=> 'required',
		),
		array(
			'field'		=> 'last_name',
			'label'		=> 'Last Name',
			'rules'		=> 'required',
		),
		array(
			'field'		=> 'username',
			'label'		=> 'Username',
			'rules'		=> 'is_unique[users.username]',				// use email as username if empty
		),
		array(
			'field'		=> 'email',
			'label'		=> 'Email',
			'rules'		=> 'required|valid_email|is_unique[users.email]',
		),
		array(
			'field'		=> 'password',
			'label'		=> 'Password',
			'rules'		=> 'required',
		),
		array(
			'field'		=> 'retype_password',
			'label'		=> 'Retype Password',
			'rules'		=> 'required|matches[password]',
		),
	),

	// Reset User Password
	'user/reset_password' => array(
		array(
			'field'		=> 'new_password',
			'label'		=> 'New Password',
			'rules'		=> 'required',
		),
		array(
			'field'		=> 'retype_password',
			'label'		=> 'Retype Password',
			'rules'		=> 'required|matches[new_password]',
		),
	),

	// Create Admin User
	'panel/admin_user_create' => array(
		array(
			'field'		=> 'username',
			'label'		=> 'Username',
			'rules'		=> 'required|is_unique[users.username]',
		),
		array(
			'field'		=> 'first_name',
			'label'		=> 'First Name',
			'rules'		=> 'required',
		),
		/* Admin User can have no email
		array(
			'field'		=> 'email',
			'label'		=> 'Email',
			'rules'		=> 'valid_email|is_unique[users.email]',
		),*/
		array(
			'field'		=> 'password',
			'label'		=> 'Password',
			'rules'		=> 'required',
		),
		array(
			'field'		=> 'retype_password',
			'label'		=> 'Retype Password',
			'rules'		=> 'required|matches[password]',
		),
	),

	// Reset Admin User Password
	'panel/admin_user_reset_password' => array(
		array(
			'field'		=> 'new_password',
			'label'		=> 'New Password',
			'rules'		=> 'required',
		),
		array(
			'field'		=> 'retype_password',
			'label'		=> 'Retype Password',
			'rules'		=> 'required|matches[new_password]',
		),
	),

	// Admin User Update Info
	'panel/account_update_info' => array(
		array(
			'field'		=> 'username',
			'label'		=> 'Username',
			'rules'		=> 'required',
		),
		array(
			'field'		=> 'password',
			'label'		=> 'Password',
			'rules'		=> 'required',
		),
        array(
            'field'     => 'first_name',
            'label'     => 'First Name',
            'rules'     => 'trim|required',
        ),
        array(
            'field'     => 'last_name',
            'label'     => 'Last Name',
            'rules'     => 'trim|required',
        ),

	),

	// Admin User Change Password
	'panel/account_change_password' => array(
		array(
			'field'		=> 'new_password',
			'label'		=> 'New Password',
			'rules'		=> 'required',
		),
		array(
			'field'		=> 'retype_password',
			'label'		=> 'Retype Password',
			'rules'		=> 'required|matches[new_password]',
		),
	),

	// Contract Management
	'contract/create' => array(
			array(
            	'field'		 => 'company_name',
            	'label'		 => 'Nama Gereja',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'pic_name',
            	'label'		 => 'Nama Gembala',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'company_address',
            	'label'		 => 'Alamat Gereja',
            	'rules'		 => 'trim|required',
        	),
            array(
                'field'      => 'long_info',
                'label'      => 'Langtitude',
                'rules'      => 'trim|decimal',
            ),
            array(
                'field'      => 'lat_info',
                'label'      => 'Latitude',
                'rules'      => 'trim|decimal',
            ),
        	array(
            	'field'		 => 'company_phone1',
            	'label'		 => 'Telepon',
            	'rules'		 => 'trim',
        	),
        	array(
            	'field'		 => 'company_phone2',
            	'label'		 => 'Telepon Lain',
            	'rules'		 => 'trim',
        	),
        	array(
            	'field'		 => 'pic_phone',
            	'label'		 => 'Hand Phone',
            	'rules'		 => 'trim',
        	),
        	array(
            	'field'		 => 'email_address',
            	'label'		 => 'Email',
            	'rules'		 => 'trim',
        	),
        	array(
            	'field'		 => 'start_date',
            	'label'		 => 'Tanggal Berdiri',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'terminate_date',
            	'label'		 => 'Tanggal Tutup',
            	'rules'		 => 'trim',
        	),
        	// array(
         //    	'field'		 => 'status_data',
         //    	'label'		 => 'Status Data',
         //    	'rules'		 => 'trim|required',
        	// ),
        ),


	'contract/update' => array(
			array(
            	'field'		 => 'company_name',
            	'label'		 => 'Nama Gereja',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'pic_name',
            	'label'		 => 'Nama Gembala',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'company_address',
            	'label'		 => 'Alamat Gereja',
            	'rules'		 => 'trim|required',
        	),
            array(
                'field'      => 'long_info',
                'label'      => 'Langtitude',
                'rules'      => 'trim|decimal',
            ),
            array(
                'field'      => 'lat_info',
                'label'      => 'Latitude',
                'rules'      => 'trim|decimal',
            ),
        	array(
            	'field'		 => 'company_phone1',
            	'label'		 => 'Telepon',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'company_phone2',
            	'label'		 => 'Telepon Lain',
            	'rules'		 => 'trim',
        	),
        	array(
            	'field'		 => 'pic_phone',
            	'label'		 => 'Hand Phone',
            	'rules'		 => 'trim',
        	),
        	array(
            	'field'		 => 'email_address',
            	'label'		 => 'Email',
            	'rules'		 => 'trim',
        	),
        	array(
            	'field'		 => 'start_date',
            	'label'		 => 'Tanggal Berdiri',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'terminate_date',
            	'label'		 => 'Tanggal Tutup',
            	'rules'		 => 'trim',
        	),
        	array(
            	'field'		 => 'status_data',
            	'label'		 => 'Status Data',
            	'rules'		 => 'trim|required',
        	),
        ),

	// Pastor Master Data
	'pastor/create' => array(
			array(
            	'field'		 => 'remarks',
            	'label'		 => 'Nama Gembala',
            	'rules'		 => 'trim|required|is_unique[pastors.remarks]',
        	),
        ),


	'pastor/update' => array(
			array(
            	'field'		 => 'remarks',
            	'label'		 => 'Nama Gembala',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'status_data',
            	'label'		 => 'Status Data',
            	'rules'		 => 'trim|required',
        	),
        ),

	'ref_rank/create' => array(
			array(
            	'field'		 => 'rank_name',
            	'label'		 => 'Nama Jabatan',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'status_data',
            	'label'		 => 'Status Data',
            	'rules'		 => 'trim',
        	),
        ),


	'ref_rank/update' => array(
			array(
            	'field'		 => 'rank_name',
            	'label'		 => 'Nama Jabatan',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'status_data',
            	'label'		 => 'Status Data',
            	'rules'		 => 'trim',
        	),
        ),

    'video/create' => array(
            array(
                'field'      => 'video_title',
                'label'      => 'Judul',
                'rules'      => 'trim|required',
            ),
            array(
                'field'      => 'video_desc',
                'label'      => 'Deskripsi',
                'rules'      => 'trim',
            ),
            array(
                'field'      => 'video_url',
                'label'      => 'URL',
                'rules'      => 'trim|required|valid_url',
            ),
            array(
                'field'      => 'publish_date',
                'label'      => 'Tgl. Publikasi',
                'rules'      => 'trim',
            ),
            array(
                'field'      => 'end_date',
                'label'      => 'Tgl. Akhir Publikasi',
                'rules'      => 'trim',
            ),
            array(
                'field'      => 'status_data',
                'label'      => 'Status Data',
                'rules'      => 'trim',
            ),
        ),


    'video/update' => array(
            array(
                'field'      => 'video_title',
                'label'      => 'Judul',
                'rules'      => 'trim|required',
            ),
            array(
                'field'      => 'video_desc',
                'label'      => 'Deskripsi',
                'rules'      => 'trim|required',
            ),
            array(
                'field'      => 'video_url',
                'label'      => 'URL',
                'rules'      => 'trim|required|valid_url',
            ),
            array(
                'field'      => 'publish_date',
                'label'      => 'Tgl. Publikasi',
                'rules'      => 'trim',
            ),
            array(
                'field'      => 'end_date',
                'label'      => 'Tgl. Akhir Publikasi',
                'rules'      => 'trim',
            ),
            array(
                'field'      => 'status_data',
                'label'      => 'Status Data',
                'rules'      => 'trim|required',
            ),
        ),

    /* Master Data Jemaat */
    'individual/create' => array(
        array(
            'field'      => 'full_name',
            'label'      => 'Nama Lengkap',
            'rules'      => 'trim|required',
        ),
        array(
            'field'      => 'nick_name',
            'label'      => 'Nama Panggilan',
            'rules'      => 'trim',
        ),
        array(
            'field'      => 'gender',
            'label'      => 'Jenis Kelamin',
            'rules'      => 'trim|required',
        ),
        array(
            'field'      => 'blood_typeid',
            'label'      => 'Gol. Darah',
            'rules'      => 'trim',
        ),
        array(
            'field'      => 'birth_date',
            'label'      => 'Tanggal Kelahiran',
            'rules'      => 'trim|required',
        ),
        array(
            'field'      => 'birth_city',
            'label'      => 'Kota Kelahiran',
            'rules'      => 'trim|required',
        ),
        array(
            'field'      => 'marriage_status',
            'label'      => 'Status Menikah',
            'rules'      => 'trim|required',
        ),
        array(
            'field'      => 'phone_num',
            'label'      => 'No. Handphone',
            'rules'      => 'trim',
        ),
        array(
            'field'      => 'contract_id',
            'label'      => 'Cabang',
            'rules'      => 'trim|required|numeric',
        ),
    ),


    'individual/update' => array(
            array(
                'field'      => 'full_name',
                'label'      => 'Nama Lengkap',
                'rules'      => 'trim|required',
            ),
            array(
                'field'      => 'nick_name',
                'label'      => 'Nama Panggilan',
                'rules'      => 'trim',
            ),
            array(
                'field'      => 'birth_date',
                'label'      => 'Tanggal Kelahiran',
                'rules'      => 'trim|required',
            ),
            array(
                'field'      => 'gender',
                'label'      => 'Jenis Kelamin',
                'rules'      => 'trim|required',
            ),
            array(
                'field'      => 'blood_typeid',
                'label'      => 'Gol. Darah',
                'rules'      => 'trim',
            ),
            array(
                'field'      => 'birth_city',
                'label'      => 'Kota Kelahiran',
                'rules'      => 'trim|required',
            ),
            array(
                'field'      => 'marriage_status',
                'label'      => 'Status Menikah',
                'rules'      => 'trim|required',
            ),
            array(
                'field'      => 'phone_num',
                'label'      => 'No. Handphone',
                'rules'      => 'trim',
            ),
            array(
                'field'      => 'contract_id',
                'label'      => 'Cabang',
                'rules'      => 'trim|required|numeric',
            ),
            array(
                'field'      => 'status_data',
                'label'      => 'Status Data',
                'rules'      => 'trim|required',
            ),
        ),

    'ref_gender/create' => array(
            array(
                'field'      => 'gender_name',
                'label'      => 'Jenis Kelamin',
                'rules'      => 'trim|required',
            ),
        ),


    'ref_gender/update' => array(
            array(
                'field'      => 'gender_name',
                'label'      => 'Jenis Kelamin',
                'rules'      => 'trim|required',
            ),
            array(
                'field'      => 'status_data',
                'label'      => 'Status Data',
                'rules'      => 'trim|required',
            ),
        ),

    'blog/create' => array(
            array(
                'field'      => 'blog_category',
                'label'      => 'Kategori Blog',
                'rules'      => 'trim|required|numeric',
            ),
            array(
                'field'      => 'title',
                'label'      => 'Judul',
                'rules'      => 'trim|required',
            ),
            array(
                'field'      => 'content_text',
                'label'      => 'Isi Blog',
                'rules'      => 'trim|required',
            ),
            array(
                'field'      => 'publish_date',
                'label'      => 'Tgl. Publikasi',
                'rules'      => 'trim|required',
            ),
            array(
                'field'      => 'end_date',
                'label'      => 'Tgl. Akhir Publikasi',
                'rules'      => 'trim|required',
            ),
        ),


    'blog/update' => array(
            array(
                'field'      => 'blog_category',
                'label'      => 'Kategori Blog',
                'rules'      => 'trim|required|numeric',
            ),
            array(
                'field'      => 'title',
                'label'      => 'Judul',
                'rules'      => 'trim|required',
            ),
            array(
                'field'      => 'content_text',
                'label'      => 'Isi Blog',
                'rules'      => 'trim|required',
            ),
            array(
                'field'      => 'publish_date',
                'label'      => 'Tgl. Publikasi',
                'rules'      => 'trim|required',
            ),
            array(
                'field'      => 'end_date',
                'label'      => 'Tgl. Akhir Publikasi',
                'rules'      => 'trim|required',
            ),
        ),

    'ref_recurrence/create' => array(
            array(
                'field'      => 'recurring_type',
                'label'      => 'Tipe Berulang',
                'rules'      => 'trim|required',
            ),
        ),


    'ref_recurrence/update' => array(
            array(
                'field'      => 'recurring_type',
                'label'      => 'Tipe Berulang',
                'rules'      => 'trim|required',
            ),
            array(
                'field'      => 'status_data',
                'label'      => 'Status Data',
                'rules'      => 'trim',
            ),
        ),

    'ref_marriage/create' => array(
            array(
                'field'      => 'status_name',
                'label'      => 'Nama Status',
                'rules'      => 'trim|required',
            ),
            array(
                'field'      => 'status_data',
                'label'      => 'Status Data',
                'rules'      => 'trim',
            ),
        ),


    'ref_marriage/update' => array(
            array(
                'field'      => 'status_name',
                'label'      => 'Nama Status',
                'rules'      => 'trim|required',
            ),
            array(
                'field'      => 'status_data',
                'label'      => 'Status Data',
                'rules'      => 'trim',
            ),
        ),

    'ref_charttype/create' => array(
            array(
                'field'      => 'type_name',
                'label'      => 'Nama Tipe Chart',
                'rules'      => 'trim|required|is_unique[ref_charttypes.type_name]',
            ),
            // array(
            //     'field'      => 'status_data',
            //     'label'      => 'Status Data',
            //     'rules'      => 'trim|required',
            // ),
        ),


    'ref_charttype/update' => array(
            array(
                'field'      => 'type_name',
                'label'      => 'Nama Tipe Chart',
                'rules'      => 'trim|required|is_unique[ref_charttypes.type_name]',
            ),
            array(
                'field'      => 'status_data',
                'label'      => 'Status Data',
                'rules'      => 'trim|required',
            ),
        ),

    'account/create' => array(
            array(
                'field'      => 'parent_id',
                'label'      => 'Rekening Induk',
                'rules'      => 'trim|required|numeric',
            ),
            array(
                'field'      => 'ref_charttype',
                'label'      => 'Tipe Rekening',
                'rules'      => 'trim|required',
            ),
            // array(
            //     'field'      => 'level_num',
            //     'label'      => 'Level',
            //     'rules'      => 'trim|required|numeric',
            // ),
            array(
                'field'      => 'chart_num',
                'label'      => 'Kode Rekening',
                'rules'      => 'trim|required|is_unique[accounts.chart_num]',
            ),
            array(
                'field'      => 'chart_name',
                'label'      => 'Nama Rekening',
                'rules'      => 'trim|required|is_unique[accounts.chart_name]',
            ),
            // array(
            //     'field'      => 'status_data',
            //     'label'      => 'Status Data',
            //     'rules'      => 'trim|required',
            // ),
        ),


    'account/update' => array(
            array(
                'field'      => 'parent_id',
                'label'      => 'Rekening Induk',
                'rules'      => 'trim|required|numeric',
            ),
            array(
                'field'      => 'ref_charttype',
                'label'      => 'Tipe Rekening',
                'rules'      => 'trim|required|numeric',
            ),
            // array(
            //     'field'      => 'level_num',
            //     'label'      => 'Level',
            //     'rules'      => 'trim|required|numeric',
            // ),
            array(
                'field'      => 'chart_num',
                'label'      => 'Kode Rekening',
                'rules'      => 'trim|required',
            ),
            array(
                'field'      => 'chart_name',
                'label'      => 'Nama Rekening',
                'rules'      => 'trim|required',
            ),
            // array(
            //     'field'      => 'status_data',
            //     'label'      => 'Status Data',
            //     'rules'      => 'trim|required',
            // ),
        ),

    'familie/create' => array(
            array(
                'field'      => 'head_fam_id',
                'label'      => 'Kepala Keluarga',
                'rules'      => 'trim|required|numeric',
            ),
            array(
                'field'      => 'family_name',
                'label'      => 'Nama Keluarga',
                'rules'      => 'trim|required',
            ),
            array(
                'field'      => 'family_description',
                'label'      => 'Keterangan',
                'rules'      => 'trim',
            ),
            array(
                'field'      => 'home_address',
                'label'      => 'Alamat Rumah',
                'rules'      => 'trim|required',
            ),
            array(
                'field'      => 'province_id',
                'label'      => 'Propinsi',
                'rules'      => 'trim',
            ),
            array(
                'field'      => 'regency_id',
                'label'      => 'Kabupaten',
                'rules'      => 'trim',
            ),
            array(
                'field'      => 'district_id',
                'label'      => 'Kecamatan',
                'rules'      => 'trim',
            ),
            array(
                'field'      => 'village_id',
                'label'      => 'Kelurahan',
                'rules'      => 'trim',
            ),
            // array(
            //     'field'      => 'status_data',
            //     'label'      => 'Status Data',
            //     'rules'      => 'trim|required',
            // ),
        ),


    'familie/update' => array(
            // array(
            //     'field'      => 'head_fam_id',
            //     'label'      => 'Kepala Keluarga',
            //     'rules'      => 'trim',
            // ),
            array(
                'field'      => 'family_name',
                'label'      => 'Nama Keluarga',
                'rules'      => 'trim|required',
            ),
            array(
                'field'      => 'family_description',
                'label'      => 'Keterangan',
                'rules'      => 'trim',
            ),
            array(
                'field'      => 'home_address',
                'label'      => 'Alamat Rumah',
                'rules'      => 'trim|required',
            ),
            array(
                'field'      => 'province_id',
                'label'      => 'Propinsi',
                'rules'      => 'trim',
            ),
            array(
                'field'      => 'regency_id',
                'label'      => 'Kabupaten',
                'rules'      => 'trim',
            ),
            array(
                'field'      => 'district_id',
                'label'      => 'Kecamatan',
                'rules'      => 'trim',
            ),
            array(
                'field'      => 'village_id',
                'label'      => 'Kelurahan',
                'rules'      => 'trim',
            ),
            array(
                'field'      => 'status_data',
                'label'      => 'Status Data',
                'rules'      => 'trim|required',
            ),
        ),

    'ref_role/create' => array(
            array(
                'field'      => 'role_description',
                'label'      => 'Deskripsi',
                'rules'      => 'trim|required',
            ),
        ),


    'ref_role/update' => array(
            array(
                'field'      => 'role_description',
                'label'      => 'Deskripsi',
                'rules'      => 'trim|required',
            ),
            array(
                'field'      => 'status_data',
                'label'      => 'Status Data',
                'rules'      => 'trim|required',
            ),
        ),

    'scripture/create' => array(
            array(
                'field'      => 'scriptures_text',
                'label'      => 'Firman Tuhan',
                'rules'      => 'trim|required',
            ),
            array(
                'field'      => 'scripture_section',
                'label'      => 'Pasal Alkitab',
                'rules'      => 'trim|required',
            ),
            array(
                'field'      => 'start_date',
                'label'      => 'Tgl. Awal',
                'rules'      => 'trim|required',
            ),
            array(
                'field'      => 'end_date',
                'label'      => 'Tgl. Selesai',
                'rules'      => 'trim|required',
            ),
        ),


    'scripture/update' => array(
            array(
                'field'      => 'scriptures_text',
                'label'      => 'Firman Tuhan',
                'rules'      => 'trim|required',
            ),
            array(
                'field'      => 'scripture_section',
                'label'      => 'Pasal Alkitab',
                'rules'      => 'trim|required',
            ),
            array(
                'field'      => 'start_date',
                'label'      => 'Tgl. Awal',
                'rules'      => 'trim|required',
            ),
            array(
                'field'      => 'end_date',
                'label'      => 'Tgl. Selesai',
                'rules'      => 'trim|required',
            ),
            array(
                'field'      => 'status_data',
                'label'      => 'Status Data',
                'rules'      => 'trim|required',
            ),
        ),

    'ref_activitie/create' => array(
            array(
                'field'      => 'activity_name',
                'label'      => 'Nama Kegiatan',
                'rules'      => 'trim|required',
            ),
        ),


    'ref_activitie/update' => array(
            array(
                'field'      => 'activity_name',
                'label'      => 'Nama Kegiatan',
                'rules'      => 'trim|required',
            ),
            array(
                'field'      => 'status_data',
                'label'      => 'Status Data',
                'rules'      => 'trim|required',
            ),
        ),

    'attendance/create' => array(
            array(
                'field'      => 'activity_date',
                'label'      => 'Tgl. Kegiatan',
                'rules'      => 'trim|required',
            ),
            array(
                'field'      => 'ref_activityid',
                'label'      => 'Nama Kegiatan',
                'rules'      => 'trim|required|numeric',
            ),
            array(
                'field'      => 'qty',
                'label'      => 'Jumlah Yg Hadir',
                'rules'      => 'trim|required|numeric',
            ),
        ),


    'attendance/update' => array(
            array(
                'field'      => 'activity_date',
                'label'      => 'Tgl. Kegiatan',
                'rules'      => 'trim|required',
            ),
            array(
                'field'      => 'ref_activityid',
                'label'      => 'Nama Kegiatan',
                'rules'      => 'trim|required|numeric',
            ),
            array(
                'field'      => 'qty',
                'label'      => 'Jumlah Yg Hadir',
                'rules'      => 'trim|required|numeric',
            ),
        ),

    'activitie/create' => array(
            array(
                'field'      => 'ref_activityid',
                'label'      => 'Nama Kegiatan',
                'rules'      => 'trim|required|numeric',
            ),
            array(
                'field'      => 'remarks',
                'label'      => 'Pelayan Firman',
                'rules'      => 'trim',
            ),
            array(
                'field'      => 'time_start',
                'label'      => 'Mulai Kegiatan',
                'rules'      => 'trim|required',
            ),
            array(
                'field'      => 'time_end',
                'label'      => 'Selesai Kegiatan',
                'rules'      => 'trim|required',
            ),
        ),


    'activitie/update' => array(
            array(
                'field'      => 'ref_activityid',
                'label'      => 'Nama Kegiatan',
                'rules'      => 'trim|required|numeric',
            ),
            array(
                'field'      => 'remarks',
                'label'      => 'Pelayan Firman',
                'rules'      => 'trim',
            ),
            array(
                'field'      => 'time_start',
                'label'      => 'Mulai Kegiatan',
                'rules'      => 'trim|required',
            ),
            array(
                'field'      => 'time_end',
                'label'      => 'Selesai Kegiatan',
                'rules'      => 'trim|required',
            ),
            array(
                'field'      => 'status_data',
                'label'      => 'Status Data',
                'rules'      => 'trim|required',
            ),
        ),

);