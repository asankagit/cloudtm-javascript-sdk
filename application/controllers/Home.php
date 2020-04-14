<?php
/**
 * Description of Home
 *
 * @author Dinum
 */
class Home extends CI_Controller {
    public function __construct(){        
        parent::__construct();
        $this->load->library('messages');
        $this->load->library('common');
        if (!$this->session->userdata('user_logged')) {
            redirect(base_url()."login");
        }        
    }
    
    public function index($msgid=""){           
        $this->header($msgid);
        $this->load->view("home");
        $this->footer();
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
