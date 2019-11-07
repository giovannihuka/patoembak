<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Activitie_model extends MY_Model
{

    public $table = 'activities';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json($contract_id = NULL) {
        $this->datatables->select('a.id, a.ref_activityid, a.remarks, b.activity_name, date_format(a.activity_date,"%d-%M-%Y") tgl, time_format(a.time_start,"%H:%i") as jam_mulai, time_format(a.time_end,"%H:%i") as jam_selesai, a.status_data, a.create_userid, a.update_userid, a.create_time, a.update_time');
        $this->datatables->from('activities a');
        $this->datatables->join('ref_activities b','b.id = a.ref_activityid','left');
        $this->db->order_by('a.ref_activityid asc, date(a.time_start) asc');
        $this->datatables->add_column('action', anchor(site_url('admin/activitie/read/$1'),'<i class=\'fa fa-eye\'></i>')."&nbsp&nbsp".anchor(site_url('admin/activitie/update/$1'),'<i class=\'fa fa-pencil-square-o\'></i>')."&nbsp&nbsp".anchor(site_url('admin/activitie/delete/$1'),'<i class=\'fa fa-trash-o\'></i>','onclick="javasciprt: return confirm(\'Anda yakin ?\')"'), 'id');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id', $q);
	$this->db->or_like('ref_activityid', $q);
	$this->db->or_like('time_start', $q);
	$this->db->or_like('time_end', $q);
	$this->db->or_like('status_data', $q);
	$this->db->or_like('create_userid', $q);
	$this->db->or_like('update_userid', $q);
	$this->db->or_like('create_time', $q);
	$this->db->or_like('update_time', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('ref_activityid', $q);
	$this->db->or_like('time_start', $q);
	$this->db->or_like('time_end', $q);
	$this->db->or_like('status_data', $q);
	$this->db->or_like('create_userid', $q);
	$this->db->or_like('update_userid', $q);
	$this->db->or_like('create_time', $q);
	$this->db->or_like('update_time', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

}

/* End of file Activitie_model.php */
/* Location: ./application/models/Activitie_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Custom Codeigniter CRUD Generator 2019-10-22 11:13:13 */