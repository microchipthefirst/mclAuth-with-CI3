<?php

//do group things
class Group extends CI_Controller {

    function __construct() {
        parent::__construct();
        session_start();
        if (!$this->session->userdata('loggedin')) {
            redirect('admin/login');
        }  else {
            if($this->session->userdata('group') != '1'){
                redirect('/admin/login');
            }
        }
    }

    function new_group() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'required|is_unique[usergroups.Name]');
        $this->form_validation->set_rules('desc', 'Description', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'admin/group';
            $this->load->view('start', $data);
        } else {
            $name = ucfirst($this->input->post('name'));
            $desc = ucfirst($this->input->post('desc'));         
            $array = array(
                'Name' => $name,
                'Description' => $desc
            );
            $this->load->model('admin/group_model');
            $this->group_model->Insert($array);
//            $this->db->insert('usergroups', $array);
            if ($this->db->affected_rows() > 0) {
                $id = $this->db->insert_id();
                $sql = 'select Name from usergroups where ID =' . $id;
                $res = $this->db->query($sql);
                redirect('admin/admin_view/list_groups');
            }
        }
    }

    function delete() {
        $id = $this->uri->segment(4);
        $this->load->model('admin/group_model');
        $result = $this->group_model->Delete($id);
        $data['id'] = $result[0]['ID'];
        $data['type'] = "group account";
        $data['action'] = 'admin/group/delete_group';
        $data['loginname'] = $result[0]['Name'];
        $data['title'] = 'admin/confirm_delete';
        $this->load->view('start', $data);
    }

    function delete_group() {
        $id = $this->input->post('id');
        $this->load->model('admin/group_model');
        $this->group_model->Delete($id);
        $result = $this->group_model->Get_Group_By_ID($id);
        if (!$result) {
            redirect('/admin/admin_view/list_groups');
        } else {
            $data['title'] = 'admin/error';
            $data['message'] = 'Deletion failed, please contact administrator';
            $this->load->view('start', $data);
        }
    }

    function activate_group() {
        $id = $this->uri->segment(4);
        $this->load->model('admin/group_model');
        $result = $this->group_model->Get_Group_By_ID($id);
        $active = $result[0]['Active'];
        if($active == '0'){
            $activate = 1;
        }else{
            $activate=0;
        }
        $array = array(
            'active'=>$activate
        );
        $this->db->where('ID',$id);
        $res = $this->db->update('usergroups',$array);
        if($this->db->affected_rows()>0){
            redirect('/admin/admin_view/list_groups');
        }else{
            
            $data['message'] = 'unable to change status';
            $data['title'] = 'admin/error';
            $this->load->view('start',$data);
        }
        $data['title'] = 'admin/activate_group';
        $this->load->view('start', $data);
    }

    function edit_group() {
        $this->load->library('form_validation');
        if ($this->input->post('orig_name') == $this->input->post('name')) {
            $this->form_validation->set_rules('name', 'Name', 'required');
        } else {
            $this->form_validation->set_rules('name', 'Name', 'required|is_unique[usergroups.Name]');
        }
        $this->form_validation->set_rules('desc', 'Description', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'admin/edit_group';
            $this->load->view('start', $data);
        } else {
            $id = $this->input->post('id');
            $name = $this->input->post('name');
            $desc = $this->input->post('desc');

            $array = array(                
                'Name' => $name,
                'Description' => $desc
            );
            $this->load->model('admin/group_model');
            $result = $this->group_model->Update($id, $array);
            if ($this->db->affected_rows()>0) {
                redirect('admin/admin_view/list_groups');
            }
            else{
                $data['message'] = 'No changes made to group';
                $data['title'] = 'admin/error';
                $this->load->view('start',$data);
            }
        }
    }

}
