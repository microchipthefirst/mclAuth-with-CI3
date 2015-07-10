<?php
class Login extends CI_Controller{
    function index(){
        $data['title'] = 'admin/login';
        $this->load->view('start',$data);
}
function loginuser(){
    $this->load->library('form_validation');
    $this->form_validation->set_rules('loginname','Login Name','required');
    $this->form_validation->set_rules('pwd','Password','required|min_length[8]');
    if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'admin/login';
            $this->load->view('start', $data);
        } else {
            $this->db->where('Username',$this->input->post('loginname'));
            $result = $this->db->get('members')->result_array();
            if(password_verify($this->input->post('pwd'),$result[0]['Password']) && $result[0]['active'] == '1'){
                //set up session data and forward to main screen
                session_start();
                $array = array(
                    'loggedin'=>TRUE,
                    'loginname'=>$result[0]['Username'],
                    'group'=>$result[0]['GroupID']
                );
                        
                $this->session->set_userdata($array);
                redirect('main');
            }else{
                //return to login screen with error
                if($result[0]['active'] == '0'){
                    $data['message'] = 'Account is not active - contact administrator';
                }else{
                $data['message'] = 'Wrong user name or password or account is inactive.';
                }
                $data['title']='admin/login';
                $this->load->view('start',$data);
            }
        }
    
}
function logout(){
    session_start();
    if($this->session->userdata('loggedin')){
        $this->session->sess_destroy();
        redirect('main');
    }
}
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

