<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Individual_model extends MY_Model
{

    public $table = 'individuals';
    public $id = 'id';
    public $order = 'ASC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json($contract_id = NULL) {
        $this->datatables->select('a.id,a.individual_code,a.first_name,a.middle_name,a.last_name,a.marriage_status,e.status_name,a.full_name,a.nick_name,d.gender_name,c.blood_type,date_format(a.birth_date,\'%d-%M\') as birth_date,a.birth_daynum,a.birth_monthnum,a.birth_city,a.phone_num,a.contract_id,b.company_name,a.status_data,a.create_userid,a.update_userid,a.create_time,a.update_time');
        $this->datatables->from('individuals a');
        $this->datatables->join('contracts b','b.contract_id = a.contract_id','left');
        $this->datatables->join('ref_bloodtypes c','c.id = a.blood_typeid','left');
        $this->datatables->join('ref_genders d','d.id = a.gender','left');
        $this->datatables->join('ref_marriages e','e.id = a.marriage_status','left');
        $this->db->order_by('a.id','ASC');

        // add this line for join
        //$this->datatables->join('table2', 'individuals.field = table2.field');

        // Remove the comment to add filtering data
        // if ($contract_id !== NULL)
        // {
        //     $this->datatables->where('[a.]contract_id', $contract_id);
        // }        
        
        $this->datatables->add_column('action', anchor(site_url('admin/individual/read/$1'),'<i class=\'fa fa-eye\'></i>')."&nbsp&nbsp".anchor(site_url('admin/individual/update/$1'),'<i class=\'fa fa-pencil-square-o\'></i>')."&nbsp&nbsp".anchor(site_url('admin/individual/disable/$1'),'<i class=\'fa fa-eraser\'></i>')."
            &nbsp&nbsp".anchor(site_url('admin/individual/delete/$1'),'<i class=\'fa fa-trash-o\'></i>','onclick="javasciprt: return confirm(\'Apakah anda yakin untuk menghapus data ini ?\')"'), 'id');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->datatables->select('a.id,a.individual_code,a.marriage_status,e.status_name,a.full_name,a.nick_name,a.gender,d.gender_name,a.blood_typeid,c.blood_type,date_format(a.birth_date,\'%Y-%M-%d\') as birth_date,a.birth_daynum,a.birth_monthnum,a.birth_city,a.phone_num,a.contract_id,b.company_name,a.status_data');
        $this->datatables->join('contracts b','b.contract_id = a.contract_id','left');
        $this->datatables->join('ref_bloodtypes c','c.id = a.blood_typeid','left');
        $this->datatables->join('ref_genders d','d.id = a.gender','left');
        $this->datatables->join('ref_marriages e','e.id = a.marriage_status','left');
        $this->db->order_by('a.id','ASC');
        return $this->db->get('individuals a')->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->datatables->select('a.id,a.individual_code,a.marriage_status,e.status_name,a.full_name,a.nick_name,a.gender,d.gender_name,a.blood_typeid,c.blood_type,date_format(a.birth_date,\'%Y-%M-%d\') as birth_date,a.birth_daynum,a.birth_monthnum,a.birth_city,a.phone_num,a.contract_id,b.company_name,a.status_data');
        $this->datatables->join('contracts b','b.contract_id = a.contract_id','left');
        $this->datatables->join('ref_bloodtypes c','c.id = a.blood_typeid','left');
        $this->datatables->join('ref_genders d','d.id = a.gender','left');
        $this->datatables->join('ref_marriages e','e.id = a.marriage_status','left');
        $this->db->where('a.id', $id);
        return $this->db->get('individuals a')->row();
    }

    // get total rows
    function total_rows($q = NULL) {
       $this->datatables->select('a.id,a.individual_code,a.marriage_status,e.status_name,a.full_name,a.nick_name,a.gender,d.gender_name,a.blood_typeid,c.blood_type,date_format(a.birth_date,\'%Y-%M-%d\') as birth_date,a.birth_daynum,a.birth_monthnum,a.birth_city,a.phone_num,a.contract_id,b.company_name,a.status_data');
       $this->datatables->join('contracts b','b.contract_id = a.contract_id','left');
       $this->datatables->join('ref_bloodtypes c','c.id = a.blood_typeid','left');
       $this->datatables->join('ref_genders d','d.id = a.gender','left');
       $this->datatables->join('ref_marriages e','e.id = a.marriage_status','left');
       $this->db->order_by('a.id', 'ASC');
       $this->db->like('a.id', $q);
       $this->db->or_like('a.full_name', $q);
       $this->db->or_like('d.gender_name', $q);
       $this->db->or_like('birth_date', $q);
       $this->db->or_like('a.individual_code',$q);
       $this->db->or_like('a.birth_city', $q);
       $this->db->or_like('a.nick_name', $q);
       $this->db->or_like('a.phone_num', $q);
       $this->db->or_like('a.status_data', $q);
	   $this->db->from('individuals a');
       return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
       $this->db->select('a.id,a.individual_code,a.marriage_status,e.status_name,a.full_name,a.nick_name,a.gender,d.gender_name,a.blood_typeid,c.blood_type,date_format(a.birth_date,\'%Y-%M-%d\') as birth_date,a.birth_daynum,a.birth_monthnum,a.birth_city,replace(i.phone_num,"-","") as phone_number,a.contract_id,b.company_name,a.status_data');
        $this->db->join('contracts b','b.contract_id = a.contract_id','left');
        $this->db->join('ref_bloodtypes c','c.id = a.blood_typeid','left');
        $this->db->join('ref_genders d','d.id = a.gender','left');
        $this->db->join('ref_marriages e','e.id = a.marriage_status','left');
        $this->db->like('a.id', $q);
    	$this->db->or_like('a.full_name', $q);
    	$this->db->or_like('d.gender_name', $q);
    	$this->db->or_like('birth_date', $q);
        $this->db->or_like('a.individual_code',$q);
        $this->db->or_like('a.birth_city', $q);
    	$this->db->or_like('a.nick_name', $q);
        $this->db->or_like('phone_number', $q);
    	$this->db->or_like('a.status_data', $q);
        $this->db->order_by('id','ASC');
    	$this->db->limit($limit, $start);
        return $this->db->get('individuals a')->result();
    }

}

/* End of file Individual_model.php */
/* Location: ./application/models/Individual_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Custom Codeigniter CRUD Generator 2018-08-13 15:29:51 */