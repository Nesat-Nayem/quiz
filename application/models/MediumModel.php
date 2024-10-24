<?php defined('BASEPATH') OR exit('No direct script access allowed');
class MediumModel extends CI_Model {
    var $table = 'medium';
    var $column_order = array(null, 'title', 'created_at', 'updated_at', null);

    var $column_search = array('title');
    var $order = array('id' => 'DESC');

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insert($insert) {
        $this->db->insert('medium', $insert);
    }

    function get_medium() {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $this->db->select('*'); // Add this line to select all columns
        $query = $this->db->get();
        return $query->result();
    }
    

    private function _get_datatables_query() {
        $this->db->from($this->table);
        $i = 0;
        foreach ($this->column_search as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search) - 1 == $i) {
                    $this->db->group_end();
                }
            }
            $i++;
        }
        
        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
    }

    function count_filtered() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function getfetch($id) {
        return $this->db->where('id', $id)->get('medium')->row_array();
    }

    function update($data, $id) {
        $this->db->where('id', $id)->update('medium', $data);
    }

    function delete($id) {
        $this->db->where('id', $id)->delete('medium');
    }
}
