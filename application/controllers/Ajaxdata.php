<?php

/**
 * Description of Ajaxdata
 *
 * @author Dinum
 */
class Ajaxdata extends CI_Controller {

    private $token;
    private $aws_url;
    private $max;

    public function __construct() {
        parent::__construct();
        $this->token = $this->session->userdata('token');
        $this->aws_url = $this->config->item('aws');
        $this->load->library('messages');
        $this->load->library('common');
        $this->load->library('curl');
        $this->load->library('validator');
    }

    public function loadData() {

        $sites = array();

        $this->curl->create($this->aws_url . 'sites');
        $headers = array(
            'Content-type:application/json',
            'Authorization:' . $this->token
        );

        $this->curl->options(array(CURLOPT_SSL_VERIFYHOST => 0, CURLOPT_SSL_VERIFYPEER => 0, CURLOPT_HTTPHEADER => $headers));
        // Execute - returns responce
        $responseObj = $this->curl->execute();

        if (empty($this->curl->error_code) && empty($this->curl->error_string)) {
            $response = json_decode($responseObj);
            $awsSites = $response->siteData;

            foreach ($awsSites as $key => $aws) {                
                $sites[$key] = array(
                    'data' => $this->getVisitorStat($aws->siteId),
                    'label' => $aws->siteName,
                    'color' => $this->random_color()
                );
            }
        }

        $colors = array();
        $result = array('data' => $sites, 'max' => $this->max);
        echo json_encode($result);
        exit();
    }

    public function getVisitorStat($siteID) {
        //$data = array();
        $visitors = $this->getVisitors($siteID);
        $datearray = $this->dateArray();
        //var_dump($datearray);
        if(isset($visitors)&&!empty($visitors)&& sizeof($visitors)>0){
            foreach ($visitors->visitorDetails as $visitor){
                //echo $visitor->time;
                //var_dump($visitor->time);
                $date = date('d', strtotime($visitor->time));
                $datearray[$date-1] = $datearray[$date-1]+1;
            }
        }    
                
        foreach ($datearray as $value) {
            if($value>$this->max){
                $this->max = $value;
            }
        }
        
        return $datearray;
    }

    public function dateArray() {
        $list = array();
        $month = date('m');
        $year = date('Y');

        for ($d = 1; $d <= 31; $d++) {
            $time = mktime(12, 0, 0, $month, $d, $year);
            if (date('m', $time) == $month)
                $list[] = 0;
        }
        return $list;
    }

    public function getVisitors($siteID) {
        $visitors = array();
        $this->curl->create($this->aws_url . 'visitors?siteId=' . $siteID);
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

    public function getData() {
        $data = array();
        for ($i = 1; $i < 20; $i++) {
            $data[$i] = array(
                'id' => $i,
                'xx' => rand(0, 10)
            );
        }
        return $data;
    }

    public function getArrayData() {
        $data = array();
        for ($i = 0; $i < 14; $i++) {
            $data[$i] = rand(0, 10);
        }
        return $data;
    }

    public function generateArray() {
        $data = array();
        for ($i = 1; $i < 20; $i++) {
            $data[$i] = rand(0, 10);
        }
        echo json_encode($data);
        exit();
    }

    function random_color_part() {
        return str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
    }

    function random_color() {
        return $this->random_color_part() . $this->random_color_part() . $this->random_color_part();
    }

}
