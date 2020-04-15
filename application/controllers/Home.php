<?php
/**
 * Description of Home
 *
 * @author Dinum
 */
class Home extends CI_Controller {
    private $aws_url;
    private $token;
    public function __construct(){        
        parent::__construct();
        $this->load->library('messages');
        $this->load->library('common');
         $this->aws_url = $this->config->item('aws');
        if (!$this->session->userdata('user_logged')) {
            redirect(base_url()."login");
        } else {
            $this->token = $this->session->userdata('token');
        }      
    }
    
    public function index($msgid=""){  
        $sites = $this->getSites();      
        $this->header($msgid);
        $this->load->view("home",array('sites'=>$sites));
        $this->footer();
    }
    
    public function getSites(){
        $sites = array();
        $this->curl->create($this->aws_url.'sites');
        $headers = array(
            'Content-type:application/json',
            'Authorization:' . $this->token
        );
        $this->curl->options(array(CURLOPT_SSL_VERIFYHOST => 0, CURLOPT_SSL_VERIFYPEER => 0, CURLOPT_HTTPHEADER => $headers));
        // Execute - returns responce
        $responseObj = $this->curl->execute();

        if (empty($this->curl->error_code) && empty($this->curl->error_string)) {
            $response = json_decode($responseObj);
            $sites = $response->siteData;
        } 
        return $sites;
    }


    public function header($msgid=""){
        if(isset($msgid)&&$msgid != ""){
    		$msg = $this->messages->returnMessage($msgid);
    	} else {
    		$msg = "";
    	}
        $this->load->view("template/header",array('msg'=>$msg));
    }
    
    public function footer(){
         $this->load->view("template/footer");
    }
    
    public function logout() {
        if (!$this->session->userdata('user_logged')) {
            redirect(base_url());
        }
        $logString = "User LogOut -  / USER - " . $this->session->userdata('user_name') . " / Date " . date("Y-m-d H:i:s");
        $this->common->custlog($this->session->userdata('user_name'),$logString,0);
        $this->session->unset_userdata('user_logged');
        $this->session->unset_userdata('user_name');
        $this->session->unset_userdata('token');
        redirect(base_url());
    }
}
