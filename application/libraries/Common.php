<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 * @author Dinum Mahawela
 * @Date : 21-03-2018
 */
class Common {
    
	function clean($string) {
	   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
	   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	}
	function clean_text($string) {
        $db = get_instance()->db->conn_id;
        $filter = $this->xss_clean($string);
        $string = mysqli_real_escape_string($db, trim($filter));
        $search = array('@<script[^>]*?>.*?</script>@si', // Strip out javascript
            '@<[\/\!]*?[^<>]*?>@si', // Strip out HTML tags
            '@<style[^>]*?>.*?</style>@siU', // Strip style tags properly
            '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments including CDATA
        );
        $text = preg_replace($search, '', $string);
        return $text;
    }
    
    
    function xss_clean($data) {
// Fix &entity\n;
        $data = str_replace(array('&amp;', '&lt;', '&gt;'), array('&amp;amp;', '&amp;lt;', '&amp;gt;'), $data);
        $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
        $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
        $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');
// Remove any attribute starting with "on" or xmlns
        $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);
// Remove javascript: and vbscript: protocols
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);
// Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);
// Remove namespaced elements (we do not need them)
        $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);
        do {
            // Remove really unwanted tags
            $old_data = $data;
            $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
        } while ($old_data !== $data);
// we are done...
        return $data;
    }
    
    function enter_log($user,$log,$values){
        
        $CI =& get_instance();
        $CI->load->model('Tbllog'); 
        
        $data = array(
            'log_date' => date("Y/m/d"),
            'log_time' => date('H:i:s'),
            'user_name' => $user,
            'description' => $log,
            'values' => (is_array($values))?json_encode(array_values($values)):$values,
            'ip_add' => $this->get_client_ip()
        );
        $CI->Tbllog->insert_data($data);
    }
    
    function enter_log_logedUser($user,$log,$values,$id){
        
        $CI =& get_instance();
        $CI->load->model('Tbllog'); 
        
        $data = array(
            'log_date' => date("Y/m/d"),
            'log_time' => date('H:i:s'),
            'user_name' => $user,
            'user_id' => $id,
            'description' => $log,
            'values' => (is_array($values))?json_encode(array_values($values)):$values,
            'ip_add' => $this->get_client_ip()
        );
        $CI->Tbllog->insert_data($data);
    }
    
    function custlog($user,$log,$id){
        $this->CI =& get_instance();
        $this->CI->load->helper('file');
        $base = $this->CI->config->item('doc_root');        
        $filename = $base.'logs/activity_cust_log_'.date('Y_m_d').'.log';
        
        $entry = date('Y-m-d H:i:s')." - ".$user." - ".$id." - ".$log." - ".$this->get_client_ip()."\n";
        
        write_file($filename, $entry,'a');                
     }
    
    function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
    
}
