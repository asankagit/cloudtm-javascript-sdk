<?php

/**
 * Description of Sites
 *
 * @author Dinum
 */
class Sites extends CI_Controller {

    private $token;

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('user_logged')) {
            redirect(base_url());
        } else {
            $this->token = $this->session->userdata('token');
        }
        $this->load->library('messages');
        $this->load->library('common');
        $this->load->library('curl');
        $this->load->library('validator');
    }

    public function index($msgid = "") {
        if (isset($msgid) && $msgid != "") {
            $msg = $this->messages->returnMessage($msgid);
        } else {
            $msg = "";
        }
        $sites = array();

        $this->curl->create('https://uiwyrsy2j2.execute-api.ap-southeast-1.amazonaws.com/Prod/sites');
        $headers = array(
            'Content-type:application/json',
            'Authorization:' . $this->token
        );

        //var_dump($headers);

        $this->curl->options(array(CURLOPT_SSL_VERIFYHOST => 0, CURLOPT_SSL_VERIFYPEER => 0, CURLOPT_HTTPHEADER => $headers));
        // Execute - returns responce
        $responseObj = $this->curl->execute();

        if (empty($this->curl->error_code) && empty($this->curl->error_string)) {
            $response = json_decode($responseObj);
            $sites = $response->siteData;
        } else {
            redirect(base_url() . "home/22");
        }
        $this->header($msgid);
        $this->load->view("sites", array('sites' => $sites));
        $this->footer();
    }

    public function add($msgid = "") {
                
        $response = array();

        if (isset($_POST['generate'])) {
            $webname = $this->common->clean_text($this->input->post('webname'));
            $weburl = $this->common->clean_text($this->input->post('weburl'));
            $webdesc = $this->common->clean_text($this->input->post('webdesc'));

            $this->curl->create('https://uiwyrsy2j2.execute-api.ap-southeast-1.amazonaws.com/Prod/sites');
            $curl_post_data = array(
                "sitename" => $webname,
                "description" => $webdesc,
                "domain" => $weburl
            );
            $headers = array(
                'Content-type:application/json',
                'Authorization:' . $this->token
            );
            $this->curl->post(json_encode($curl_post_data));
            $this->curl->options(array(CURLOPT_SSL_VERIFYHOST => 0, CURLOPT_SSL_VERIFYPEER => 0, CURLOPT_HTTPHEADER => $headers));
            // Execute - returns responce
            $responseObj = $this->curl->execute();
            
            if(empty($this->curl->error_code)&&empty($this->curl->error_string)){
               $response = json_decode($responseObj);
               if(!empty($response->siteId)){
                   redirect(base_url() . "sites/23");
               }
            } else {
                redirect(base_url() . "sites/22");
            }        
        }

        $this->header($msgid);
        $this->load->view("addSite",array('response'=>$response));
        $this->footer();
    }
    
    public function details($msgid = "",$siteid) {
        if(empty($siteid)){
            redirect(base_url() . "sites/19");
        } else {
            
        }
    }

    public function header($msgid = "") {
        if (isset($msgid) && $msgid != "") {
            $msg = $this->messages->returnMessage($msgid);
        } else {
            $msg = "";
        }
        $this->load->view("template/header", array('msg' => $msg));
    }

    public function footer() {
        $this->load->view("template/footer");
    }

}
