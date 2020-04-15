<?php

/**
 * Description of Sites
 *
 * @author Dinum
 */
class Sites extends CI_Controller {

    private $token;
    private $aws_url;

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('user_logged')) {
            redirect(base_url());
        } else {
            $this->token = $this->session->userdata('token');
        }
        $this->aws_url = $this->config->item('aws');
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

        $this->curl->create($this->aws_url.'sites');
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

            $this->curl->create($this->aws_url.'sites');
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

            if (empty($this->curl->error_code) && empty($this->curl->error_string)) {
                $response = json_decode($responseObj);
                if (!empty($response->siteId)) {
                    redirect(base_url() . "sites/23");
                }
            } else {
                redirect(base_url() . "sites/22");
            }
        }

        $this->header($msgid);
        $this->load->view("addSite", array('response' => $response));
        $this->footer();
    }

    public function details($siteid, $msgid = "") {
        $sitedata = array();
        $visitors = array();
        $scrolls = array();
        $streams = array();
        if (empty($siteid)) {
            redirect(base_url() . "sites/19");
        } else {
            $sitedata = $this->getSiteDetails($siteid);
            if (isset($sitedata->siteId) && !empty($sitedata->siteId)) {
                $visitors = $this->getVisitors($sitedata->siteId);
                $scrolls = $this->getScrollDetails($sitedata->siteId);
                $streams = $this->getClickStream($sitedata->siteId);
            } else {
                redirect(base_url() . "sites/22");
            }
        }
        $this->header($msgid);
        $this->load->view("viewSite", array('site' => $sitedata, 'visitors' => $visitors, 'scrolls' => $scrolls,'streams'=>$streams));
        $this->footer();
    }

    public function getSiteDetails($siteID) {
        $sitedata = array();
        $this->curl->create($this->aws_url.'sites');
        $headers = array(
            'Content-type:application/json',
            'Authorization:' . $this->token
        );
        $this->curl->options(array(CURLOPT_SSL_VERIFYHOST => 0, CURLOPT_SSL_VERIFYPEER => 0, CURLOPT_HTTPHEADER => $headers));
        $responseObj = $this->curl->execute();

        if (empty($this->curl->error_code) && empty($this->curl->error_string)) {
            $response = json_decode($responseObj);
            $sites = $response->siteData;
            foreach ($sites as $site) {
                if ($site->siteId == $siteID) {
                    $sitedata = $site;
                    break;
                }
            }
        } 
        return $sitedata;
    }
    
    public function getClickStream($siteID) {
        $streams = array();
        $this->curl->create($this->aws_url.'clickstream?siteId=' . $siteID);
        $headers = array(
            'Content-type:application/json',
            'Authorization:' . $this->token
        );
        $this->curl->options(array(CURLOPT_SSL_VERIFYHOST => 0, CURLOPT_SSL_VERIFYPEER => 0, CURLOPT_HTTPHEADER => $headers));
        $response = $this->curl->execute();
        if (empty($this->curl->error_code) && empty($this->curl->error_string)) {
            $streams = json_decode($response);
        }
        return $streams;
    }

    public function getVisitors($siteID) {
        $visitors = array();
        $this->curl->create($this->aws_url.'visitors?siteId=' . $siteID);
        $headers = array(
            'Content-type:application/json',
            'Authorization:' . $this->token
        );
        $this->curl->options(array(CURLOPT_SSL_VERIFYHOST => 0, CURLOPT_SSL_VERIFYPEER => 0, CURLOPT_HTTPHEADER => $headers));
        $response = $this->curl->execute();
        if (empty($this->curl->error_code) && empty($this->curl->error_string)) {
            $visitors = json_decode($response);
        }
        return $visitors;
    }

    public function getScrollDetails($siteID) {
        $scrolls = array();
        $this->curl->create($this->aws_url.'scrollSummary?siteId=' . $siteID);
        $headers = array(
            'Content-type:application/json',
            'Authorization:' . $this->token
        );
        $this->curl->options(array(CURLOPT_SSL_VERIFYHOST => 0, CURLOPT_SSL_VERIFYPEER => 0, CURLOPT_HTTPHEADER => $headers));
        $response = $this->curl->execute();
        if (empty($this->curl->error_code) && empty($this->curl->error_string)) {
            $scrolls = json_decode($response);
        }
        return $scrolls;
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
