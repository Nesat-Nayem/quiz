<?php defined('BASEPATH') OR exit('No direct script access allowed');

class StudentClassModel extends CI_Model 
{
    private $table = 'student_classes';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_student_class($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function get_student_class_by_id($id) {
        return $this->db->where('id', $id)->get($this->table)->row();
    }

    public function get_all_student_classes() {
        return $this->db->get($this->table)->result();
    }

    public function update_student_class($id, $data) {
        $this->db->set($data)->where('id', $id)->update($this->table);
        return $this->db->affected_rows();
    }

    public function delete_student_class($id) {
        $this->db->where('id', $id)->delete($this->table);
        return $this->db->affected_rows();
    }
}
