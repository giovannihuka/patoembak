<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Blog_model extends MY_Model
{

    public $table = 'blogs';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json($contract_id = NULL) {
        $this->datatables->select('id,blog_category,title,content_text,publish_date,end_date,create_userid,update_userid,create_time,update_time');
        $this->datatables->from('blogs');

        // add this line for join
        //$this->datatables->join('table2', 'blogs.field = table2.field');

        // Remove the comment to add filtering data
        // if ($contract_id !== NULL)
        // {
        //     $this->datatables->where('[a.]contract_id', $contract_id);
        // }        
        
        $this->datatables->add_column('action', anchor(site_url('admin/blog/read/$1'),'<i class=\'fa fa-eye\'></i>')."&nbsp&nbsp".anchor(site_url('admin/blog/update/$1'),'<i class=\'fa fa-pencil-square-o\'></i>')."&nbsp&nbsp".anchor(site_url('admin/blog/delete/$1'),'<i class=\'fa fa-trash-o\'></i>','onclick="javasciprt: return confirm(\'Anda yakin ?\')"'), 'id');
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
	$this->db->or_like('blog_category', $q);
	$this->db->or_like('title', $q);
	$this->db->or_like('content_text', $q);
	$this->db->or_like('publish_date', $q);
	$this->db->or_like('end_date', $q);
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
	$this->db->or_like('blog_category', $q);
	$this->db->or_like('title', $q);
	$this->db->or_like('content_text', $q);
	$this->db->or_like('publish_date', $q);
	$this->db->or_like('end_date', $q);
	$this->db->or_like('create_userid', $q);
	$this->db->or_like('update_userid', $q);
	$this->db->or_like('create_time', $q);
	$this->db->or_like('update_time', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

}

/* End of file Blog_model.php */
/* Location: ./application/models/Blog_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Custom Codeigniter CRUD Generator 2018-10-17 10:15:45 */