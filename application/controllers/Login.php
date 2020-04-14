<?php
/**
 * Description of Login
 *
 * @author Dinum
 */
class Login extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('user_logged')) {
            redirect(base_url());
        }
        $this->load->library('messages');
        $this->load->library('common');
        $this->load->library('curl'); 
    }
    
    public function index($msgid=""){
        if(isset($msgid)&&$msgid != ""){
    		$msg = $this->messages->returnMessage($msgid);
    	} else {
    		$msg = "";
    	}
        if(isset($_POST['login'])){
            
            $uname = $this->common->clean_text($this->input->post('uname'));
            $psword = $this->common->clean_text($this->input->post('password'));
            
            if($uname!=""&&$psword!=""){
                
                $this->curl->create('https://uiwyrsy2j2.execute-api.ap-southeast-1.amazonaws.com/Prod/users/signIn');
                $curl_post_data = array(
                        "username" => $uname,
                        "password" => $psword
                );
                $headers = array(
                    'Content-type: application/json'
                );
                $this->curl->post(json_encode($curl_post_data));
                $this->curl->options(array(CURLOPT_SSL_VERIFYHOST => 0,CURLOPT_SSL_VERIFYPEER => 0, CURLOPT_HTTPHEADER => $headers));
                // Execute - returns responce
                $responseObj = $this->curl->execute();

                if(empty($this->curl->error_code)&&empty($this->curl->error_string)){
                    $response = json_decode($responseObj);
                    if(!empty($response->token)){  
                        $this->session->unset_userdata('user_logged');
                        $this->session->unset_userdata('user_name');
                        $this->session->unset_userdata('token');
                        
                        $sessionArray = array(
                            'user_logged' => true,
                            'user_name' => $uname,
                            'token' => $response->token
                        );
                        $this->session->set_userdata($sessionArray);
                        $logString = "User Login -  / USER - " . $this->session->userdata('user_name') . " / Date " . date("Y-m-d H:i:s");
                        $this->common->custlog($this->session->userdata('user_name'),$logString,0);
                        redirect(base_url()."home/8"); 
                    } else {
                       redirect(base_url()."login/10"); 
                    }
                } else {
                    redirect(base_url()."login/10");
                }
            } else {
                redirect(base_url()."login/10");
            }                    
        }
        $this->header();
        $this->load->view("login",array('msg'=>$msg));
        $this->footer();
    }  
    
    public function header() {
        $this->load->view("template/signHeader");
    }
    
    public function footer() {
        $this->load->view("template/signFooer");
    }
     
}
