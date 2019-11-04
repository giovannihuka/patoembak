<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Map_model extends MY_Model
{
	public $table = 'contracts';
	public $id = 'contract_id';

	function __construct()
	{
		parent::__construct();
	}

	function get_all()
	{
		$this->db->select('company_name,pic_name,long_info,lat_info,company_address');
		$this->db->where('status_data','Aktif');
		return $this->db->get($this->table)->result_array();
	}

	function minmax_latlng()
	{
		$sql_query = "select min(c.long_info) 'min_long', max(c.long_info) 'max_long',
			min(c.lat_info) 'min_lat', max(c.lat_info) 'max_lat' from contracts c
			where c.status_data = 'Aktif';";
		return $this->db->query($sql_query)->result_array();
	}
}