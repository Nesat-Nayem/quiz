<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Paper extends Admin_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('PaperModel');
        $this->load->library('form_validation');
    }

    public function index() {
        $this->set_title('Paper List');
        $data = $this->includes;
        $content_data = array('papers' => $this->PaperModel->get_all_papers());
        $data['content'] = $this->load->view('admin/paper/list', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }

    public function add() {
        $this->form_validation->set_rules('title', 'Title', 'required|trim|is_unique[papers.title]');

        if ($this->form_validation->run() == false) {
            $this->set_title('Add Paper');
            $data = $this->includes;
            $data['content'] = $this->load->view('admin/paper/form', NULL, TRUE);
            $this->load->view($this->template, $data);
        } else {
            $data = array('title' => $this->input->post('title', TRUE));
            $this->PaperModel->insert_paper($data);
            $this->session->set_flashdata('message', 'Paper added successfully');
            redirect('admin/paper');
        }
    }

    public function update($id = NULL) {
        if (empty($id)) {
            $this->session->set_flashdata('error', 'Invalid URL');
            redirect('admin/paper');
        }

        $paper = $this->PaperModel->get_paper_by_id($id);
        if (empty($paper)) {
            $this->session->set_flashdata('error', 'Invalid ID');
            redirect('admin/paper');
        }

        $this->form_validation->set_rules('title', 'Title', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->set_title('Update Paper');
            $data = $this->includes;
            $content_data = array('paper' => $paper);
            $data['content'] = $this->load->view('admin/paper/form', $content_data, TRUE);
            $this->load->view($this->template, $data);
        } else {
            $data = array('title' => $this->input->post('title', TRUE));
            $this->PaperModel->update_paper($id, $data);
            $this->session->set_flashdata('message', 'Paper updated successfully');
            redirect('admin/paper');
        }
    }

    public function delete($id = NULL) {
        $this->PaperModel->delete_paper($id);
        $this->session->set_flashdata('message', 'Paper deleted successfully');
        redirect('admin/paper');
    }
}
