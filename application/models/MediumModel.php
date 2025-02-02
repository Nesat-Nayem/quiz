<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MediumModel extends CI_Model 
{
    private $table = 'mediums';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_medium($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function get_medium_by_id($id) {
        return $this->db->where('id', $id)->get($this->table)->row();
    }

    public function get_all_mediums() {
        return $this->db->get($this->table)->result();
    }

    public function update_medium($id, $data) {
        $this->db->set($data)->where('id', $id)->update($this->table);
        return $this->db->affected_rows();
    }

    public function delete_medium($id) {
        $this->db->where('id', $id)->delete($this->table);
        return $this->db->affected_rows();
    }
}
