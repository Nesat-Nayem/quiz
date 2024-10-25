<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Medium extends Admin_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('MediumModel');
        $this->load->library('form_validation');
    }

    public function index() {
        $this->set_title('Medium List');
        $data = $this->includes;
        $content_data = array('mediums' => $this->MediumModel->get_all_mediums());
        $data['content'] = $this->load->view('admin/medium/list', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }

    public function add() {
        $this->form_validation->set_rules('title', 'Title', 'required|trim|is_unique[mediums.title]');

        if ($this->form_validation->run() == false) {
            $this->set_title('Add Medium');
            $data = $this->includes;
            $data['content'] = $this->load->view('admin/medium/form', NULL, TRUE);
            $this->load->view($this->template, $data);
        } else {
            $data = array('title' => $this->input->post('title', TRUE));
            $this->MediumModel->insert_medium($data);
            $this->session->set_flashdata('message', 'Medium added successfully');
            redirect('admin/medium');
        }
    }

    public function update($id = NULL) {
        if (empty($id)) {
            $this->session->set_flashdata('error', 'Invalid URL');
            redirect('admin/medium');
        }

        $medium = $this->MediumModel->get_medium_by_id($id);
        if (empty($medium)) {
            $this->session->set_flashdata('error', 'Invalid ID');
            redirect('admin/medium');
        }

        $this->form_validation->set_rules('title', 'Title', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->set_title('Update Medium');
            $data = $this->includes;
            $content_data = array('medium' => $medium);
            $data['content'] = $this->load->view('admin/medium/form', $content_data, TRUE);
            $this->load->view($this->template, $data);
        } else {
            $data = array('title' => $this->input->post('title', TRUE));
            $this->MediumModel->update_medium($id, $data);
            $this->session->set_flashdata('message', 'Medium updated successfully');
            redirect('admin/medium');
        }
    }

    public function delete($id = NULL) {
        $this->MediumModel->delete_medium($id);
        $this->session->set_flashdata('message', 'Medium deleted successfully');
        redirect('admin/medium');
    }
}
