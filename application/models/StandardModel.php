<?php defined('BASEPATH') OR exit('No direct script access allowed');

class StandardModel extends CI_Model 
{
    private $table = 'standards';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_standard($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function get_standard_by_id($id) {
        return $this->db->where('id', $id)->get($this->table)->row();
    }

    public function get_all_standards() {
        return $this->db->get($this->table)->result();
    }

    public function update_standard($id, $data) {
        $this->db->set($data)->where('id', $id)->update($this->table);
        return $this->db->affected_rows();
    }

    public function delete_standard($id) {
        $this->db->where('id', $id)->delete($this->table);
        return $this->db->affected_rows();
    }
}
