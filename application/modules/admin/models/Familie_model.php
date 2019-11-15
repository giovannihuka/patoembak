<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Familie_model extends MY_Model
{

    public $table = 'families';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json($contract_id = NULL) {
        $this->datatables->select('a.id, a.head_fam_id, b.full_name, a.family_name, a.home_address, a.province_id, c.name nama_propinsi, a.regency_id, d.name nama_kabupaten, a.district_id, e.name nama_kecamatan, a.village_id, f.name nama_kelurahan, a.family_description, a.status_data, a.create_userid, a.update_userid,a.create_time, a.update_time');
        $this->datatables->from('families a');
        $this->datatables->join('individuals b','b.id = a.head_fam_id','left');
        $this->datatables->join('ref_provinces c','c.id = a.province_id','left');
        $this->datatables->join('ref_regencies d','d.id = a.regency_id','left');
        $this->datatables->join('ref_districts e','e.id = a.district_id','left');
        $this->datatables->join('ref_villages f','f.id = a.village_id','left');
        $this->datatables->add_column('action', anchor(site_url('admin/familie/read/$1'),'<i class=\'fa fa-eye\'></i>')."&nbsp&nbsp".anchor(site_url('admin/familie/update/$1'),'<i class=\'fa fa-pencil-square-o\'></i>')."&nbsp&nbsp".anchor(site_url('admin/familie/delete/$1'),'<i class=\'fa fa-trash-o\'></i>','onclick="javasciprt: return confirm(\'Apakah anda yakin untuk menghapus data ini ?\')"'), 'id');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        // $this->db->order_by($this->id, $this->order);
        // return $this->db->get($this->table)->result();

        $this->datatables->select('a.id, a.head_fam_id, b.full_name, a.family_name, a.home_address, a.province_id, c.name nama_propinsi, a.regency_id, d.name nama_kabupaten, a.district_id, e.name nama_kecamatan, a.village_id, f.name nama_kelurahan, a.family_description, a.status_data, a.create_userid, a.update_userid,a.create_time, a.update_time');
        // $this->datatables->from('families a');
        $this->datatables->join('individuals b','b.id = a.head_fam_id','left');
        $this->datatables->join('ref_provinces c','c.id = a.province_id','left');
        $this->datatables->join('ref_regencies d','d.id = a.regency_id','left');
        $this->datatables->join('ref_districts e','e.id = a.district_id','left');
        $this->datatables->join('ref_villages f','f.id = a.village_id','left');
        $this->db->order_by('a.id','ASC');
        return $this->db->get('families a')->result();
    }

    // get data by id
    function get_by_id($id)
    {
        // $this->db->where($this->id, $id);
        // return $this->db->get($this->table)->row();

        $this->datatables->select('a.id, a.head_fam_id, b.full_name, a.family_name, a.home_address, a.province_id, c.name nama_propinsi, a.regency_id, d.name nama_kabupaten, a.district_id, e.name nama_kecamatan, a.village_id, f.name nama_kelurahan, a.family_description, a.status_data, a.create_userid, a.update_userid,a.create_time, a.update_time');
        // $this->datatables->from('families a');
        $this->datatables->join('individuals b','b.id = a.head_fam_id','left');
        $this->datatables->join('ref_provinces c','c.id = a.province_id','left');
        $this->datatables->join('ref_regencies d','d.id = a.regency_id','left');
        $this->datatables->join('ref_districts e','e.id = a.district_id','left');
        $this->datatables->join('ref_villages f','f.id = a.village_id','left');
        $this->db->order_by('a.id','ASC');
        $this->db->where('a.id', $id);
        return $this->db->get('families a')->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id', $q);
	$this->db->or_like('head_fam_id', $q);
	$this->db->or_like('family_name', $q);
	$this->db->or_like('family_description', $q);
	$this->db->or_like('home_address', $q);
	$this->db->or_like('province_id', $q);
	$this->db->or_like('regency_id', $q);
	$this->db->or_like('district_id', $q);
	$this->db->or_like('village_id', $q);
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
	$this->db->or_like('head_fam_id', $q);
	$this->db->or_like('family_name', $q);
	$this->db->or_like('family_description', $q);
	$this->db->or_like('home_address', $q);
	$this->db->or_like('province_id', $q);
	$this->db->or_like('regency_id', $q);
	$this->db->or_like('district_id', $q);
	$this->db->or_like('village_id', $q);
	$this->db->or_like('status_data', $q);
	$this->db->or_like('create_userid', $q);
	$this->db->or_like('update_userid', $q);
	$this->db->or_like('create_time', $q);
	$this->db->or_like('update_time', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

}

/* End of file Familie_model.php */
/* Location: ./application/models/Familie_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Custom Codeigniter CRUD Generator 2019-10-01 06:38:00 */