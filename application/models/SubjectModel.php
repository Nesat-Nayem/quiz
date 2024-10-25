<?php defined('BASEPATH') OR exit('No direct script access allowed');

class SubjectModel extends CI_Model 
{
    private $table = 'subjects';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_subject($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function get_subject_by_id($id) {
        return $this->db->where('id', $id)->get($this->table)->row();
    }

    public function get_all_subjects() {
        return $this->db->get($this->table)->result();
    }

    public function update_subject($id, $data) {
        $this->db->set($data)->where('id', $id)->update($this->table);
        return $this->db->affected_rows();
    }

    public function delete_subject($id) {
        $this->db->where('id', $id)->delete($this->table);
        return $this->db->affected_rows();
    }
}
