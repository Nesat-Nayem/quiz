<?php defined('BASEPATH') OR exit('No direct script access allowed');

class PaperModel extends CI_Model 
{
    private $table = 'papers';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_paper($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function get_paper_by_id($id) {
        return $this->db->where('id', $id)->get($this->table)->row();
    }

    public function get_all_papers() {
        return $this->db->get($this->table)->result();
    }

    public function update_paper($id, $data) {
        $this->db->set($data)->where('id', $id)->update($this->table);
        return $this->db->affected_rows();
    }

    public function delete_paper($id) {
        $this->db->where('id', $id)->delete($this->table);
        return $this->db->affected_rows();
    }
}
