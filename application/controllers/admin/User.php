<?php

class User extends CI_Controller {

    function __construct() {
        parent::__construct();
      
        if (!$this->session->userdata('loggedin')) {
            redirect('/admin/login');
        } else {
            if ($this->session->userdata('group') != '1') {
                redirect('/admin/login');
            }
        }
    }

    function new_user() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('passwd', 'Password', 'required|min_length[8]|matches[confpwd]|callback_validatePassword');
        $this->form_validation->set_rules('confpwd', 'Confirm password', 'required|min_length[8]');
        $this->form_validation->set_rules('loginname', 'Login name', 'required|is_unique[members.username]');
        $this->form_validation->set_rules('fname', 'First name', 'required');
        $this->form_validation->set_rules('lname', 'Last name', 'required');
        $this->form_validation->set_rules('group', 'Group', 'required');
        $this->form_validation->set_rules('email', 'E-mail', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'admin/new_user';
            $this->load->view('start', $data);
        } else {
            $this->load->model('admin/user_model');
            $fname = ucfirst($this->input->post('fname'));
            $lname = ucfirst($this->input->post('lname'));
            $login = $this->input->post('loginname');
            $email = $this->input->post('email');
            $group = $this->input->post('group');
            $pw = password_hash($this->input->post('passwd'), PASSWORD_DEFAULT);
            $array = array(
                'fname' => $fname,
                'lname' => $lname,
                'Username' => $login,
                'email' => $email,
                'GroupID' => $group,
                'Password' => $pw
            );
            $id = $this->user_model->Insert($array);
            if ($id) {
                redirect('admin/admin_view/list_users');
            }
        }
    }

    function edit() {
        $this->load->library('form_validation');
        if ($this->input->post('orig_loginname') == $this->input->post('loginname')) {
            $this->form_validation->set_rules('loginname', 'Login name', 'required');
        } else {
            $this->form_validation->set_rules('loginname', 'Login name', 'required|is_unique[members.username]');
        }
        $this->form_validation->set_rules('fname', 'First name', 'required');
        $this->form_validation->set_rules('lname', 'Last name', 'required');
        $this->form_validation->set_rules('group', 'Group', 'required');
        $this->form_validation->set_rules('email', 'E-mail', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'admin/edit_user';
            $this->load->view('start', $data);
        } else {

            $fname = $this->input->post('fname');
            $lname = $this->input->post('lname');
            $login = $this->input->post('loginname');
            $email = $this->input->post('email');
            $group = $this->input->post('group');
            $id = $this->input->post('id');
            $array = array(
                'fname' => $fname,
                'lname' => $lname,
                'Username' => $login,
                'email' => $email,
                'GroupID' => $group
            );
            $this->load->model('admin/user_model');
            $result = $this->user_model->Update($id, $array);
            if ($this->db->affected_rows() > 0) {
                redirect('admin/admin_view/list_users');
            }
        }
    }

    function delete_user() {
        $id = $this->input->post('id');
        $this->load->model('admin/user_model');
        $this->user_model->delete($id);
        $res = $this->user_model->Get_User_By_ID($id);
        if (!$res) {
//            echo 'ok';
            redirect('/admin/admin_view/list_users');
        } else {
            echo 'oops';
//            $data['title'] = 'admin/error';
//            $data['message'] = 'Deletion failed, please contact administrator';
//            $this->load->view('start', $data);
        }
    }

    function activate_user() {
        $id = $this->uri->segment(4);
        $this->load->model('admin/user_model');
        $result = $this->user_model->Get_User_By_ID($id);
        $active = $result[0]['active'];
        if ($active == '0') {
            $activate = 1;
        } else {
            $activate = 0;
        }
        $array = array(
            'active' => $activate
        );
        $this->db->where('ID', $id);
        $res = $this->db->update('members', $array);
        if ($this->db->affected_rows() > 0) {
            redirect('/admin/admin_view/list_users');
        } else {
            $data['message'] = 'unable to change status';
            $data['title'] = 'admin/error';
            $this->load->view('start', $data);
        }
    }

    function reset_pwd() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('passwd', 'Password', 'required|min_length[8]|matches[confpwd]|callback_validatePassword');
        $this->form_validation->set_rules('confpwd', 'Confirm password', 'required|min_length[8]');
        $this->form_validation->set_rules('id','ID');
        if ($this->form_validation->run() == FALSE) {
            $data['mess'] = $this->input->post('mess');
            $data['title'] = 'admin/reset_pwd';
            $this->load->view('start', $data);
        } else {
            $pwd = password_hash($this->input->post('passwd'), PASSWORD_DEFAULT);
            $id = $this->input->post('id');
            $this->db->where('ID', $id);
            $array = array(
                'Password' => $pwd
            );
            $this->load->model('admin/user_model');
            $result = $this->user_model->Update($id, $array);
            if ($this->db->affected_rows() > 0) {
                redirect('admin/admin_view/list_users');
            } else {
                $data['title'] = 'admin/error';
                $data['message'] = 'Failed to change password';
                $this->load->view('start', $data);
            }
        }
    }
    function validatePassword($password, $minLength = 8,$flags = SF_VALIDATE_PASS_ALL) {
        // Make sure we got a valid minimum length.
//        $password = $this->input->post('passwd');
//        echo $password;
//        if (!is_int($minLength) || $minLength < 0) {
//            trigger_error('Minimum length must be a positive integer', E_USER_ERROR);
//        }

        // Create the constraints for the password.
        $passReg = '';
        if ($flags & SF_VALIDATE_PASS_LOWER) {
            $passReg .= '(?=.*[a-z])';
        }
        if ($flags & SF_VALIDATE_PASS_UPPER) {
            $passReg .= '(?=.*[A-Z])';
        }
        if ($flags & SF_VALIDATE_PASS_NUMERICAL) {
            $passReg .= '(?=.*\\d)';
        }
        if ($flags & SF_VALIDATE_PASS_SPECIAL) {
            $special = preg_quote(',.;:"\'!?*(){}[]/^§|#¤%&_=<>@£$€ +-', '/');
            $passReg .= "(?=.*[$special])";
        }

//         Add the minimum length requirement.
        $passReg .= '.{8,}';
#
        // Check that the password matches the constraints, and return a boolean.
        if (!preg_match("/^$passReg\\z/u", $password)) {
            $this->form_validation->set_message('validatePassword','Password does not meet complexity rules<br /> a-z A-Z 0-9 and special characters');
            return false;
        }

        return $password;
    }
}

/*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */

    