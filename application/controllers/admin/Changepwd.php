<?php

class Changepwd extends CI_Controller {

    function index() {

        $data['title'] = 'admin/changepwd';
        $this->load->view('start', $data);
    }

    function reset() {
#loginname, opwd, npwd, rpwd
#check passwords are equal and right length
        #if user exists
        #if opwd = existing pw
        #write new pw
        #else
        #report error
        #else report error
        $this->load->library('form_validation');
        $this->form_validation->set_rules('loginname', 'Login name', 'required');
        $this->form_validation->set_rules('opwd', 'Old Password', 'required');
        $this->form_validation->set_rules('npwd', 'New password', 'required|min_length[8]|matches[rpwd]|callback_validatePassword');
        $this->form_validation->set_rules('rpwd', 'Repeat password', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'admin/changepwd';
            $this->load->view('start', $data);
        } else {
            $this->load->model('admin/mdl');
            $array = array(
                'UserName' => $this->input->post('loginname')
            );
            $result = $this->mdl->get_where_custom('members', $array)->result_array();
            if ($result) {
                if (password_verify($this->input->post('opwd'), $result[0]['Password'])) {
                    $pw = password_hash($this->input->post('npwd'), PASSWORD_DEFAULT);
                    $array = array(
                        'Password'=>$pw
                    );                    
                    $this->mdl->_update('members', $result[0]['ID'],$array);
                    $n = $this->db->affected_rows();
                    if($n > 0){
                        $data['message'] = 'Password changed OK';
                        $data['title'] = 'admin/login';
                        $this->load->view('start',$data);
                    }else{
                        $data['message'] = 'Problem with login name or password.  No change made.';
                    $data['title'] = 'admin/error';
                    $this->load->view('start', $data);
                    }
                } else {
                    $data['message'] = 'Problem with login name or password.  No change made.';
                    $data['title'] = 'admin/error';
                    $this->load->view('start', $data);
                }
            } else {
                $data['message'] = 'Problem with login name or password.  No change made.';
                $data['title'] = 'admin/error';
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

