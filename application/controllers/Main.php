<?php
class Main extends CI_Controller{
    function index(){       
        $data['title']='home';
        $this->load->view('start',$data);      
}
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

