<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Standard extends Admin_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('StandardModel');
        $this->load->library('form_validation');
    }

    public function index() {
        $this->set_title('Standard List');
        $data = $this->includes;
        $content_data = array('standards' => $this->StandardModel->get_all_standards());
        $data['content'] = $this->load->view('admin/standard/list', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }

    public function add() {
        $this->form_validation->set_rules('title', 'Title', 'required|trim|is_unique[standards.title]');

        if ($this->form_validation->run() == false) {
            $this->set_title('Add Standard');
            $data = $this->includes;
            $data['content'] = $this->load->view('admin/standard/form', NULL, TRUE);
            $this->load->view($this->template, $data);
        } else {
            $data = array('title' => $this->input->post('title', TRUE));
            $this->StandardModel->insert_standard($data);
            $this->session->set_flashdata('message', 'Standard added successfully');
            redirect('admin/standard');
        }
    }

    public function update($id = NULL) {
        if (empty($id)) {
            $this->session->set_flashdata('error', 'Invalid URL');
            redirect('admin/standard');
        }

        $standard = $this->StandardModel->get_standard_by_id($id);
        if (empty($standard)) {
            $this->session->set_flashdata('error', 'Invalid ID');
            redirect('admin/standard');
        }

        $this->form_validation->set_rules('title', 'Title', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->set_title('Update Standard');
            $data = $this->includes;
            $content_data = array('standard' => $standard);
            $data['content'] = $this->load->view('admin/standard/form', $content_data, TRUE);
            $this->load->view($this->template, $data);
        } else {
            $data = array('title' => $this->input->post('title', TRUE));
            $this->StandardModel->update_standard($id, $data);
            $this->session->set_flashdata('message', 'Standard updated successfully');
            redirect('admin/standard');
        }
    }

    public function delete($id = NULL) {
        $this->StandardModel->delete_standard($id);
        $this->session->set_flashdata('message', 'Standard deleted successfully');
        redirect('admin/standard');
    }
}
