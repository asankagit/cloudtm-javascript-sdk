<?php
/**
 * Description of Signup
 *
 * @author Dinum
 */
class Signup extends CI_Controller {
    
    private $aws_url;
    
    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('user_logged')) {
            redirect(base_url());
        }
        $this->aws_url = $this->config->item('aws');
        $this->load->library('messages');
        $this->load->library('common');
        $this->load->library('curl'); 
        $this->load->library('validator');
    }
    
    public function index($msgid=""){
        if(isset($msgid)&&$msgid != ""){
    		$msg = $this->messages->returnMessage($msgid);
    	} else {
    		$msg = "";
    	}
        
        $errors = array();
        
        if(isset($_POST['signup'])){
            $uname = $this->common->clean_text($this->input->post('uname'));
            $email = $this->common->clean_text($this->input->post('email'));
            $psword = $this->common->clean_text($this->input->post('password'));
            $repsword = $this->common->clean_text($this->input->post('repassword'));
            
            $erro = false;
            
            if(empty($uname)){
                $errors['uname'] = "Please enter username";
                $erro = true;
            } 
            
            if(empty($email)){
                $errors['email'] = "Please enter Email";
                $erro = true;
            } else if(!$this->validator->validate_email($email)){
                $errors['email'] = "Please enter valid Email";
                $erro = true;
            }
            
            if(empty($psword)){
                $errors['password'] = "Please enter Password";
                $erro = true;
            }
            
            if(empty($repsword)){
                $errors['repassword'] = "Please enter Password again";
                $erro = true;
            }
            
            if(!empty($psword)&&!empty($repsword)&&$repsword!=$psword){
                $errors['password'] = "Please enter correct password";
                $errors['repassword'] = "Please enter correct password";
                $erro = true;
            }
            
            if(!$erro){
                $this->curl->create($this->aws_url.'users/signUp');
                $curl_post_data = array(
                        "username" => $uname,
                        "email" => $email,
                        "password" => $repsword
                );
                $headers = array(
                    'Content-type: application/json'
                );
                $this->curl->post(json_encode($curl_post_data));
                $this->curl->options(array(CURLOPT_SSL_VERIFYHOST => 0,CURLOPT_SSL_VERIFYPEER => 0, CURLOPT_HTTPHEADER => $headers));
                // Execute - returns responce
                $responseObj = $this->curl->execute();

                if(empty($this->curl->error_code)&&empty($this->curl->error_string)){
                    redirect(base_url()."login/24");
                } else {
                    redirect(base_url()."signup/21");
                }
            } else {
               $msg = $this->messages->returnMessage(20);
            }
        }
        
        $this->header();
        $this->load->view("signup",array('msg'=>$msg,'errors'=>$errors));
        $this->footer();
    }
    
    public function header() {
        $this->load->view("template/signHeader");
    }
    
    public function footer() {
        $this->load->view("template/signFooer");
    }
}
