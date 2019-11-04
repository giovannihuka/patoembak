	<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Map extends MY_Controller
{

    function __construct()
	{
		parent::__construct();
		// $this->load->library('leaflet');
		$this->load->model('Map_model');
	}

	private $scripts = array(
		// 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.3/leaflet.js',
		'https://maps.google.com/maps/api/js?sensor=true',
	);

	private $stylesheet = array(
		'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.3/leaflet.css',
	);

	// public function index()
	// {
	// 	$this->add_script($this->scripts,FALSE,'foot');
	// 	$this->add_stylesheet($this->stylesheet,FALSE,'screen');

	// 	$map_data = $this->Map_model->get_all();
	// 	$minmax_map = $this->Map_model->minmax_latlng();

	// 	foreach ($minmax_map as $row) {
	// 		$minmax_bound = array(
	// 			'min_val' => $row['min_long'].','.$row['min_lat'],
	// 			'max_val' => $row['max_long'].','.$row['max_lat'],
	// 		);
	// 	}

	// 	$config = array(
	// 		'fitBounds'		=> '[['.$minmax_bound['min_val'].'],['.$minmax_bound['max_val'].']]',
	// 	);

	// 	$this->leaflet->initialize($config);

	// 	foreach ($map_data as $row) {
	// 		$html = '<table><tr><td style=\'font-weight:bold;\'>'.$row['company_name'].'</td></tr><tr><td>'.$row['pic_name'].'</td></tr></table>';
			
	// 		$marker = array(
	// 			'latlng'		=> $row['long_info'].','.$row['lat_info'],
	// 			'popupContent'	=> $html,
	// 		);
	// 		$this->leaflet->add_marker($marker);
	// 	}

	// 	$this->mViewData['map'] = $this->leaflet->create_map();
	// 	$this->mPageTitle = 'Peta Jakarta';
	// 	$this->render('map/map_list');
	// }

	public function index()
	{
		$this->load->library('googlemaps');


		$map_data = $this->Map_model->get_all();
		$minmax_map = $this->Map_model->minmax_latlng();

		foreach ($minmax_map as $row) {
			$minmax_bound = array(
				'min_val' => $row['min_long'].','.$row['min_lat'],
				'max_val' => $row['max_long'].','.$row['max_lat'],
			);
		}

		$config['center'] = '37.4419, -122.1419';
		$config['zoom'] = 'auto';
		$config['disableDefaultUI'] = true;
		$this->googlemaps->initialize($config);

		foreach ($map_data as $row) {
			$html = '<table><tr><td style=\'font-weight:bold;\'>'.$row['company_name'].'</td></tr><tr><td>'.$row['pic_name'].'</td></tr></table>';
			// $html = '<table><tr><td style=\'font-weight:bold;\'>'.$row['company_name'].'</td></tr><tr><td>'.$row['pic_name'].'</td></tr><tr></tr><tr><td>'.$row['company_address'].'</td></tr></table>';
			$marker = array(
				'position'	=> $row['long_info'].','.$row['lat_info'],
				// 'title' => $row['company_name'],
				'infowindow_content' => $html,
				'visible' => true,
			);
			$this->googlemaps->add_marker($marker);
		}

		// $marker = array();
		// $marker['position'] = '37.429, -122.1519';
		// $marker['infowindow_content'] = '1 - Hello World!';
		// $marker['icon'] = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=A|9999FF|000000';
		// $this->googlemaps->add_marker($marker);

		// $marker = array();
		// $marker['position'] = '37.409, -122.1319';
		// $marker['draggable'] = TRUE;
		// $marker['animation'] = 'DROP';
		// $this->googlemaps->add_marker($marker);

		// $marker = array();
		// $marker['position'] = '37.449, -122.1419';
		// $marker['onclick'] = 'alert("You just clicked me!!")';
		// $this->googlemaps->add_marker($marker);

		// $data['map'] = $this->googlemaps->create_map();

		// $this->load->view('map/map_list', $data);
		$this->mViewData['map'] = $this->googlemaps->create_map();
		$this->mPageTitle = 'Peta Cabang';
		$this->render('map/map_list', 'full_width');
	}
}

