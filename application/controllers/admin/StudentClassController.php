<?php defined('BASEPATH') OR exit('No direct script access allowed');

class StudentClassController extends Admin_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('StudentClassModel');
        $this->load->library('form_validation');
    }

    public function index() {
        $this->set_title('Student Class List');
        $data = $this->includes;
        $content_data = array('student_classes' => $this->StudentClassModel->get_all_student_classes());
        $data['content'] = $this->load->view('admin/student_class/list', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }

    public function add() {
        $this->form_validation->set_rules('title', 'Title', 'required|trim|is_unique[student_classes.title]');

        if ($this->form_validation->run() == false) {
            $this->set_title('Add Student Class');
            $data = $this->includes;
            $data['content'] = $this->load->view('admin/student_class/form', NULL, TRUE);
            $this->load->view($this->template, $data);
        } else {
            $data = array('title' => $this->input->post('title', TRUE));
            $this->StudentClassModel->insert_student_class($data);
            $this->session->set_flashdata('message', 'Student Class added successfully');
            redirect('admin/student-class');
        }
    }

    public function update($id = NULL) {
        if (empty($id)) {
            $this->session->set_flashdata('error', 'Invalid URL');
            redirect('admin/student-class');
        }

        $student_class = $this->StudentClassModel->get_student_class_by_id($id);
        if (empty($student_class)) {
            $this->session->set_flashdata('error', 'Invalid ID');
            redirect('admin/student-class');
        }

        $this->form_validation->set_rules('title', 'Title', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->set_title('Update Student Class');
            $data = $this->includes;
            $content_data = array('student_class' => $student_class);
            $data['content'] = $this->load->view('admin/student_class/form', $content_data, TRUE);
            $this->load->view($this->template, $data);
        } else {
            $data = array('title' => $this->input->post('title', TRUE));
            $this->StudentClassModel->update_student_class($id, $data);
            $this->session->set_flashdata('message', 'Student Class updated successfully');
            redirect('admin/student-class');
        }
    }

    public function delete($id = NULL) {
        $this->StudentClassModel->delete_student_class($id);
        $this->session->set_flashdata('message', 'Student Class deleted successfully');
        redirect('admin/student-class');
    }
}
