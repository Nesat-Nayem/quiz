<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ClassController extends Admin_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('ClassModel');
        $this->load->library('form_validation');
    }

    public function index() {
        $this->set_title('Class List');
        $data = $this->includes;
        $content_data = array('classes' => $this->ClassModel->get_all_classes());
        $data['content'] = $this->load->view('admin/class/list', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }

    public function add() {
        $this->form_validation->set_rules('title', 'Title', 'required|trim|is_unique[classes.title]');

        if ($this->form_validation->run() == false) {
            $this->set_title('Add Class');
            $data = $this->includes;
            $data['content'] = $this->load->view('admin/class/form', NULL, TRUE);
            $this->load->view($this->template, $data);
        } else {
            $data = array('title' => $this->input->post('title', TRUE));
            $this->ClassModel->insert_class($data);
            $this->session->set_flashdata('message', 'Class added successfully');
            redirect('admin/class');
        }
    }

    public function update($id = NULL) {
        if (empty($id)) {
            $this->session->set_flashdata('error', 'Invalid URL');
            redirect('admin/class');
        }

        $class = $this->ClassModel->get_class_by_id($id);
        if (empty($class)) {
            $this->session->set_flashdata('error', 'Invalid ID');
            redirect('admin/class');
        }

        $this->form_validation->set_rules('title', 'Title', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->set_title('Update Class');
            $data = $this->includes;
            $content_data = array('class' => $class);
            $data['content'] = $this->load->view('admin/class/form', $content_data, TRUE);
            $this->load->view($this->template, $data);
        } else {
            $data = array('title' => $this->input->post('title', TRUE));
            $this->ClassModel->update_class($id, $data);
            $this->session->set_flashdata('message', 'Class updated successfully');
            redirect('admin/class');
        }
    }

    public function delete($id = NULL) {
        $this->ClassModel->delete_class($id);
        $this->session->set_flashdata('message', 'Class deleted successfully');
        redirect('admin/class');
    }
}
