<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Member_model extends MY_Model
{

    public $table = 'members';
    public $id = 'id';
    public $order = 'ASC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json($contract_id = NULL) {
        $this->datatables->select('a.id,a.first_name,a.middle_name,a.last_name,a.full_name,a.nick_name,d.gender_name,c.blood_type,date_format(a.birth_date,\'%d-%M\') as birth_date,a.birth_daynum,a.birth_monthnum,a.birth_city,a.phone_num,a.contract_id,b.company_name,a.status_data,a.create_userid,a.update_userid,a.create_time,a.update_time');
        $this->datatables->from('members a');
        $this->datatables->join('contracts b','b.contract_id = a.contract_id','left');
        $this->datatables->join('ref_bloodtypes c','c.id = a.blood_typeid','left');
        $this->datatables->join('ref_genders d','d.id = a.gender','left');
        $this->db->order_by('id','ASC');

        // add this line for join
        //$this->datatables->join('table2', 'members.field = table2.field');

        // Remove the comment to add filtering data
        // if ($contract_id !== NULL)
        // {
        //     $this->datatables->where('[a.]contract_id', $contract_id);
        // }        
        
        $this->datatables->add_column('action', anchor(site_url('admin/member/read/$1'),'<i class=\'fa fa-eye\'></i>')."&nbsp&nbsp".anchor(site_url('admin/member/update/$1'),'<i class=\'fa fa-pencil-square-o\'></i>')."&nbsp&nbsp".anchor(site_url('admin/member/delete/$1'),'<i class=\'fa fa-trash-o\'></i>','onclick="javasciprt: return confirm(\'Anda yakin ?\')"'), 'id');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->datatables->select('a.id,a.full_name,a.nick_name,a.gender,d.gender_name,a.blood_typeid,c.blood_type,date_format(a.birth_date,\'%Y-%M-%d\') as birth_date,a.birth_city,a.phone_num,a.contract_id,b.company_name,a.status_data');
        $this->datatables->join('contracts b','b.contract_id = a.contract_id','left');
        $this->datatables->join('ref_bloodtypes c','c.id = a.blood_typeid','left');
        $this->datatables->join('ref_genders d','d.id = a.gender','left');
        // $this->db->order_by('id','ASC');
        return $this->db->get('members a')->result();
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
	$this->db->or_like('first_name', $q);
	$this->db->or_like('middle_name', $q);
	$this->db->or_like('last_name', $q);
    $this->db->or_like('full_name', $q);
	$this->db->or_like('nick_name', $q);
    $this->db->or_like('gender_name', $q);
    $this->db->or_like('blood_type', $q);
	$this->db->or_like('birth_date', $q);
	$this->db->or_like('birth_daynum', $q);
	$this->db->or_like('birth_monthnum', $q);
	$this->db->or_like('birth_city', $q);
	$this->db->or_like('phone_num', $q);
	$this->db->or_like('contract_id', $q);
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
	$this->db->or_like('first_name', $q);
	$this->db->or_like('middle_name', $q);
	$this->db->or_like('last_name', $q);
    $this->db->or_like('full_name', $q);
	$this->db->or_like('nick_name', $q);
    $this->db->or_like('gender_name', $q);
    $this->db->or_like('blood_type', $q);
	$this->db->or_like('birth_date', $q);
	$this->db->or_like('birth_daynum', $q);
	$this->db->or_like('birth_monthnum', $q);
	$this->db->or_like('birth_city', $q);
	$this->db->or_like('phone_num', $q);
	$this->db->or_like('contract_id', $q);
	$this->db->or_like('status_data', $q);
	$this->db->or_like('create_userid', $q);
	$this->db->or_like('update_userid', $q);
	$this->db->or_like('create_time', $q);
	$this->db->or_like('update_time', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

}

/* End of file Member_model.php */
/* Location: ./application/models/Member_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Custom Codeigniter CRUD Generator 2018-08-13 15:29:51 */