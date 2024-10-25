<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ClassModel extends CI_Model 
{
    private $table = 'classes';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_class($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function get_class_by_id($id) {
        return $this->db->where('id', $id)->get($this->table)->row();
    }

    public function get_all_classes() {
        return $this->db->get($this->table)->result();
    }

    public function update_class($id, $data) {
        $this->db->set($data)->where('id', $id)->update($this->table);
        return $this->db->affected_rows();
    }

    public function delete_class($id) {
        $this->db->where('id', $id)->delete($this->table);
        return $this->db->affected_rows();
    }
}
