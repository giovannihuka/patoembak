<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Attendance_model extends MY_Model
{

    public $table = 'attendances';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json($contract_id = NULL) {
        $this->datatables->select('a.id,a.activity_date,a.ref_activityid,a.qty,b.activity_name');
        $this->datatables->from('attendances a');
        $this->datatables->join('ref_activities b','b.id = a.ref_activityid','left');
        $this->db->order_by('a.activity_date','DESC');
        $this->db->order_by('a.id','ASC');
        $this->datatables->add_column('action', anchor(site_url('admin/attendance/read/$1'),'<i class=\'fa fa-eye\'></i>')."&nbsp&nbsp".anchor(site_url('admin/attendance/update/$1'),'<i class=\'fa fa-pencil-square-o\'></i>'), 'id');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->datatables->select('a.id,a.activity_date,a.ref_activityid,a.qty,b.activity_name');
        $this->datatables->from('attendances a');
        $this->datatables->join('ref_activities b','b.id = a.ref_activityid','left');
        $this->db->order_by('a.activity_date','DESC');
        $this->db->order_by('a.id','ASC');
        return $this->db->get('attendances a')->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->datatables->select('a.id,a.activity_date,a.ref_activityid,a.qty,b.activity_name');
        $this->datatables->from('attendances a');
        $this->datatables->join('ref_activities b','b.id = a.ref_activityid','left');
        $this->db->where('a.id', $id);
        return $this->db->get('attendances a')->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->datatables->select('a.id,a.activity_date,a.ref_activityid,a.qty,b.activity_name');
        $this->datatables->from('attendances a');
        $this->datatables->join('ref_activities b','b.id = a.ref_activityid','left');
        $this->db->like('a.id', $q);
        $this->db->or_like('a.activity_date', $q);
        $this->db->or_like('b.activity_name', $q);
        // $this->db->from('attendances a');
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->datatables->select('a.id,a.activity_date,a.ref_activityid,a.qty,b.activity_name');
        // $this->datatables->from('attendances a');
        $this->datatables->join('ref_activities b','b.id = a.ref_activityid','left');
        // $this->db->order_by('a.id', 'DESC');
        $this->db->like('a.id', $q);
        $this->db->or_like('a.activity_date', $q);
        $this->db->or_like('b.activity_name', $q);
        $this->db->limit($limit, $start);
        return $this->db->get('attendances a')->result();
    }

}

/* End of file Attendance_model.php */
/* Location: ./application/models/Attendance_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Custom Codeigniter CRUD Generator 2019-10-17 16:53:48 */