<?php 

class Video_list_model extends MY_Model {

	public $table = 'videos';
	public $id = 'id';

	function __construct()
	{
		parent::__construct();
	}

	function get_all()
	{
		$this->db->where("curdate() between publish_date and end_date");
		$this->db->where("status_data = 'Aktif'");
		$this->db->order_by('sequence_num','desc');
		$this->db->limit(6);
		return $this->db->get($this->table);
	}

	function get_by_id($id)
	{
		$this->db->where($this->id,$id);
		return $this->db->get($this->table)->row();
	}

}