<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Subject extends Admin_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('SubjectModel');
        $this->load->library('form_validation');
    }

    public function index() {
        $this->set_title('Subject List');
        $data = $this->includes;
        $content_data = array('subjects' => $this->SubjectModel->get_all_subjects());
        $data['content'] = $this->load->view('admin/subject/list', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }

    public function add() {
        $this->form_validation->set_rules('title', 'Title', 'required|trim|is_unique[subjects.title]');

        if ($this->form_validation->run() == false) {
            $this->set_title('Add Subject');
            $data = $this->includes;
            $data['content'] = $this->load->view('admin/subject/form', NULL, TRUE);
            $this->load->view($this->template, $data);
        } else {
            $data = array('title' => $this->input->post('title', TRUE));
            $this->SubjectModel->insert_subject($data);
            $this->session->set_flashdata('message', 'Subject added successfully');
            redirect('admin/subject');
        }
    }

    public function update($id = NULL) {
        if (empty($id)) {
            $this->session->set_flashdata('error', 'Invalid URL');
            redirect('admin/subject');
        }

        $subject = $this->SubjectModel->get_subject_by_id($id);
        if (empty($subject)) {
            $this->session->set_flashdata('error', 'Invalid ID');
            redirect('admin/subject');
        }

        $this->form_validation->set_rules('title', 'Title', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->set_title('Update Subject');
            $data = $this->includes;
            $content_data = array('subject' => $subject);
            $data['content'] = $this->load->view('admin/subject/form', $content_data, TRUE);
            $this->load->view($this->template, $data);
        } else {
            $data = array('title' => $this->input->post('title', TRUE));
            $this->SubjectModel->update_subject($id, $data);
            $this->session->set_flashdata('message', 'Subject updated successfully');
            redirect('admin/subject');
        }
    }

    public function delete($id = NULL) {
        $this->SubjectModel->delete_subject($id);
        $this->session->set_flashdata('message', 'Subject deleted successfully');
        redirect('admin/subject');
    }
}
