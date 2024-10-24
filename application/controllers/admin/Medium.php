<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Medium extends Admin_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('MediumModel');
        $this->load->library('form_validation');
    }

    function index() {
        $this->set_title('Medium List');
        $data = $this->includes;
        $content_data = array();
        $data['content'] = $this->load->view('admin/medium/list', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }

    function form($id = null) {
        $editData = "";
        if ($id) {
            $editData = $this->MediumModel->getfetch($id);
        }

        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        
        if ($this->form_validation->run() != false) {
            $content = array();
            $content['title'] = $this->input->post('title', TRUE);
            
            if ($this->input->post('Save', TRUE)) {
                $this->MediumModel->insert($content);
                $this->session->set_flashdata('message', 'Medium added successfully');
                redirect(base_url('admin/medium'));
            }
            if ($this->input->post('Update', TRUE)) {
                $this->MediumModel->update($content, $id);
                $this->session->set_flashdata('message', 'Medium updated successfully');
                redirect(base_url('admin/medium'));
            }
        }

        $this->set_title('Add Medium');
        $data = $this->includes;
        $content_data = array('editData' => $editData);
        $data['content'] = $this->load->view('admin/medium/form', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }

    function medium_list() {
        $list = $this->MediumModel->get_medium();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $medium) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $medium->title;
            $row[] = date('Y-m-d H:i:s', strtotime($medium->created_at));
            $row[] = date('Y-m-d H:i:s', strtotime($medium->updated_at));
            $row[] = '<a href="'.base_url("admin/medium/form/".$medium->id).'" class="btn btn-primary btn-action mr-1"><i class="fas fa-pencil-alt"></i></a>
                     <a href="'.base_url("admin/medium/delete/".$medium->id).'" class="btn btn-danger btn-action mr-1 medium_delete"><i class="fas fa-trash"></i></a>';
            $data[] = $row;
        }
    
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->MediumModel->count_all(),
            "recordsFiltered" => $this->MediumModel->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
    

    function delete($id = NULL) {
        $this->MediumModel->delete($id);
        $this->session->set_flashdata('message', 'Medium deleted successfully');
        redirect(base_url('admin/medium'));
    }
}
