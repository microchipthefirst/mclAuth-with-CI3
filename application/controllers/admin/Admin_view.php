<?php

class Admin_view extends CI_Controller {

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

    function index() {
        $data['title'] = 'admin/adminuser';
        $this->load->view('start', $data);
    }

    function admin() {
        $data['title'] = 'admin/adminuser';
        $this->load->view('start', $data);
    }

    function login() {
        $data['title'] = 'admin/login';
        $this->load->view('start', $data);
    }

    function create_user() {
        $this->load->model('admin/group_model');
        $result = $this->group_model->Get_ActiveGroups();
        $str = "<select class='form-control' name='group' size='2'>";
        foreach ($result as $d) {
            if ($d['ID'] == '2') {
                $selected = 'selected';
            } else {
                $selected = "";
            }
            $str .= "<option value=" . $d['ID'] . " $selected>" . $d['Name'] . " </option>";
        }
        $str .= "</select>";
        $data['group'] = $str;
        $data['title'] = 'admin/new_user';
        $this->load->view('start', $data);
    }

    function create_group() {
        $data['title'] = 'admin/new_group';
        $this->load->view('start', $data);
    }

    function activate_user() {
//        $sql = 'select ID, fname as "Firstname", lname as "Lastname", active as "Active" from members order by ID';
//        $this->load->model('mdl');
//        $result = $this->mdl->_custom_query($sql);
        $this->load->model('admin/user_model');
        $result = $this->user_model->Get_AllUsers();
        if ($result) {
            $str = "<table id ='myTable' class='table table-striped'>";
            $str .= "<tr>";
            foreach ($result[0] as $key => $value) {
                $str .= "<td >$key</td>";
            }
            $str .= "</tr>";
            foreach ($result as $arr) {
                $str .="<tr>";
                foreach ($arr as $key => $value) {
                    if ($key == 'ID') {
                        $id = $value;
                    } elseif ($key == 'Active') {
                        if ($value == '1') {
                            $toggle = 'Deactivate';
                        } else {
                            $toggle = "Activate";
                        }
                    }


                    $str .= "<td>$value</td>";
                }
                $str .= "<td><a href='/admin/user/activate_user/" . $id . "' class='btn btn-sm'>$toggle</a>";
            }
            $str .= "</tr></table>";
            $data['result'] = $str;
        } else {
            $data['result'] = 'No users listed';
        }
//        $data['result'] = $result;
        $data['title'] = 'admin/activate_user';
        $this->load->view('start', $data);
    }

    function activate_group() {
         $this->load->model('admin/group_model');
        $result = $this->group_model->Get_Groups();
        if ($result) {
            $str = "<table id ='myTable' class='table table-striped'>";
            $str .= "<tr>";
            foreach ($result[0] as $key => $value) {
                $str .= "<td >$key</td>";
            }
            $str .= "</tr>";
            foreach ($result as $arr) {
                $str .="<tr>";
                foreach ($arr as $key => $value) {
                    if ($key == 'ID') {
                        $id = $value;
                    } elseif ($key == 'Active') {
                        if ($value == '1') {
                            $toggle = 'Deactivate';
                        } else {
                            $toggle = "Activate";
                        }
                    }


                    $str .= "<td>$value</td>";
                }
                $str .= "<td><a href='/admin/group/activate_group/" . $id . "' class='btn btn-sm'>$toggle</a>";
            }
            $str .= "</tr></table>";
            $data['result'] = $str;
//            $check = '$key == "Active"';
//            $response = 'if ($value == "1") {
//                            $toggle = "Deactivate";
//                        } else {
//                            $toggle = "Activate";
//                        }
//                    ';
//            $optionbuttons = array(
//                'Edit'=>'/admin/group/activate_group'
//            );
//            $class = "class='btn btn-sm'";
//            $str = $this->extra->getTable($result,$optionbuttons,$class, $check, $response);
//
//            $data['result'] = $str;
        } else {
            $data['result'] = 'No groups listed';
        }
        $data['title'] = 'admin/activate_group';
        $this->load->view('start', $data);
    }

    function edit_user() {
        $id = $this->uri->segment(4);
        $this->load->model('admin/user_model');
        $result = $this->user_model->Get_User_Where_With_Labels($id);
        $this->db->where('Active', '1');
        $group = $this->db->get('usergroups')->result_array();
        $str = "<select class='form-control' name='group' size='2'>";
        foreach ($group as $d) {
            if ($d['ID'] == '2') {
                $selected = 'selected';
            } else {
                $selected = "";
            }
            $str .= "<option value=" . $d['ID'] . " $selected>" . $d['Name'] . " </option>";
        }
        $str .= "</select>";
        $data['group'] = $str;
        $array = array(
            'id' => $result[0]['ID'],
            'fname' => $result[0]['Firstname'],
            'lname' => $result[0]['Lastname'],
            'loginname' => $result[0]['Loginname'],
            'group' => $result[0]['Group'],
            'email' => $result[0]['E-mail']
        );
        $data['result'] = $array;
        $data['title'] = 'admin/edit_user';
        $this->load->view('start', $data);

//        $data['title'] = 'admin/edituser';
//        $this->load->view('start', $data);
    }

    function delete_user() {
        $id = $this->uri->segment(4);
        $this->load->model('admin/user_model');
        $result = $this->user_model->Get_User_By_ID($id);
        $data['id'] = $result[0]['ID'];
        $data['loginname'] = $result[0]['Username'];
        $data['type'] = 'user account';
        $data['action'] = '/admin/user/delete_user';
        $data['title'] = 'admin/confirm_delete';
        $this->load->view('start', $data);
    }

    function edit_group() {
        $id = $this->uri->segment(4);
//        $this->db->where('id', $id);
//        $result = $this->db->get('usergroups')->result_array();
        $this->load->model('admin/group_model');
        $result = $this->group_model->Get_Group_By_ID($id);
        $array = array(
            'id' => $result[0]['ID'],
            'name' => $result[0]['Name'],
            'desc' => $result[0]['Description']
        );
        $data['result'] = $array;
        $data['title'] = 'admin/edit_group';
        $this->load->view('start', $data);
    }

    function delete_group() {
        $id = $this->uri->segment(4);
        $this->load->model('admin/group_model');
        $result = $this->group_model->Get_Group_By_ID($id);
        $data['id'] = $result[0]['ID'];
        $data['loginname'] = $result[0]['Name'];
        $data['type'] = 'group account';
        $data['action'] = '/admin/group/delete_group';
        $data['title'] = 'admin/confirm_delete';
        $this->load->view('start', $data);
    }

    function reset_pwd() {
        $id = $this->uri->segment(4);
        $this->load->model('admin/user_model');        
        $result = $this->user_model->Get_User_By_ID($id);
        $array = array(
            'id' => $result[0]['ID'],
            'fname' => $result[0]['fname'],
            'lname' => $result[0]['lname'],
            'loginname' => $result[0]['Username']
        );
        $data['result'] = $array;
        $data['title'] = 'admin/reset_pwd';
        $this->load->view('start', $data);
    }

    function list_users() {
        $this->load->model('admin/user_model');
        $result = $this->user_model->Get_AllUsers();
        if ($result) {
            $this->load->model('admin/extra');
            $optionbuttons = array(
                'Edit' => '/admin/admin_view/edit_user/',
                'Delete' => '/admin/admin_view/delete_user/',
                'Reset pwd'=> '/admin/admin_view/reset_pwd/'
            );
            $class = "class='btn btn-sm'";
            $check = '';
            $response = '';
            $str = $this->extra->getTable($result, $optionbuttons, $class, $check, $response);            
            $data['result'] = $str;
        } else {
            $data['result'] = 'No users listed';
        }
        $data['title'] = 'admin/user_list';
        $this->load->view('start', $data);
    }

    function list_groups() {
        $this->load->model('admin/group_model');
        $result = $this->group_model->Get_Groups();
        if ($result) {
            $this->load->model('admin/extra');
            $optionbuttons = array(
                'Edit' => '/admin/admin_view/edit_group/',
                'Delete' => '/admin/admin_view/delete_group/'
            );
            $class = "class='btn btn-sm'";
            $check = '';
            $response = '';
            $str = $this->extra->getTable($result, $optionbuttons, $class, $check, $response);
            $data['result'] = $str;
        } else {
            $data['result'] = 'No groups listed';
        }
        $data['title'] = 'admin/group_list';
        $this->load->view('start', $data);
    }
    

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

