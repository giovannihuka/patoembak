<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ref_acccategorie_model extends MY_Model
{

    public $table = 'ref_acccategories';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json($contract_id = NULL) {
        $this->datatables->select('a.id,a.in_outid,b.reference_name,a.category_name,a.status_data,a.create_userid,a.update_userid,a.create_time,a.update_time');
        $this->datatables->from('ref_acccategories a');
        $this->datatables->join('ref_accountings b','b.id = a.in_outid','left');
        $this->db->order_by('b.id','DESC');
        $this->db->order_by('a.category_name','ASC');
        // add this line for join
        //$this->datatables->join('table2', 'ref_acccategories.field = table2.field');

        // Remove the comment to add filtering data
        // if ($contract_id !== NULL)
        // {
        //     $this->datatables->where('[a.]contract_id', $contract_id);
        // }        
        
        $this->datatables->add_column('action', anchor(site_url('admin/ref_acccategorie/read/$1'),'<i class=\'fa fa-eye\'></i>')."&nbsp&nbsp".anchor(site_url('admin/ref_acccategorie/update/$1'),'<i class=\'fa fa-pencil-square-o\'></i>')."&nbsp&nbsp".anchor(site_url('admin/ref_acccategorie/delete/$1'),'<i class=\'fa fa-trash-o\'></i>','onclick="javasciprt: return confirm(\'Apakah anda yakin untuk menghapus data ini ?\')"'), 'id');
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
	$this->db->or_like('in_outid', $q);
	$this->db->or_like('category_name', $q);
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
	$this->db->or_like('in_outid', $q);
	$this->db->or_like('category_name', $q);
	$this->db->or_like('status_data', $q);
	$this->db->or_like('create_userid', $q);
	$this->db->or_like('update_userid', $q);
	$this->db->or_like('create_time', $q);
	$this->db->or_like('update_time', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

}

/* End of file Ref_acccategorie_model.php */
/* Location: ./application/models/Ref_acccategorie_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Custom Codeigniter CRUD Generator 2019-11-08 16:00:11 */