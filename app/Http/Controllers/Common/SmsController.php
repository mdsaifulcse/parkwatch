<?php

namespace App\Http\Controllers\Common;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller;

/*
*---------------------------------------------------------------
*                           SMS GATEWAY
*---------------------------------------------------------------

*---------------------------------------------------------------
*  | HOW TO USE 
*  -------------
*  | load library
*  | $this->load->library('sms_lib');
*  | or
*  | $sms_lib = new SMS_lib;
*  | 
*  | $template = "Your template with %custom_id% and %custom_name%";
*  | $template_config = array(
*  |    'custom_id' => '30252',
*  |    'custom_name' => 'Jane Doe'
*  | );
*  | 
*  | If you don't have custom template then you can send direct message
*  | ->message($template)
*  | Destination / to must be integer (don't use qoute)
*  | ->to(0123456789)
*  | 
*  | $this->sms_lib->provider("provider_name")
*  |        ->api_key("api key or handle")
*  |        ->username("username")
*  |        ->password("password or user id")
*  |        ->from("form")
*  |        ->to("to")
*  |        ->message($template, $template_config)
*  |        ->response();
*  |         
*---------------------------------------------------------------
* NOTE: Only supported nexmo, clickatell, budgetsms & robi
*---------------------------------------------------------------
*/

class SmsController extends Controller
{ 
    private $_provider = "nexmo";
    private $_url;
    private $_data;
    private $_api_key;
    private $_username;
    private $_password;
    private $_from;
    private $_to;
    private $_message; 


    public function provider($provider = null)
    {
        $this->_provider = $provider;
        return $this;
    }


    public function api_key($api_key = null)
    {
        $this->_api_key = urldecode($api_key);
        return $this;
    }


    public function username($username = null)
    {
        $this->_username = urldecode($username);
        return $this;
    }


    public function password($password = null)
    {
        $this->_password = urldecode($password);
        return $this;
    }


    public function from($from = null)
    {
        $this->_from = urldecode($from);
        return $this;
    }


    public function to($to = null)
    {
        $this->_to = urldecode($to);
        return $this;
    }


    public function message($template = null, $data = array())
    {
        $message = $template;
        if (is_array($data) && sizeof($data) > 0)
        {
            $message = $this->_template($template, $data);
        }
        $this->_message = urldecode($message);
        return $this;
    }


    public function response()
    {
        switch ($this->_provider) 
        {
            case 'budgetsms':
                    $this->_budgetsms();
                break; 
            case 'nexmo':
                    $this->_nexmo();
                break; 
             case 'clickatell':
                    $this->_clickatell();
                break; 
             case 'robi':
                    $this->_robi();
                break; 
            default:
                    return json_encode(array(
                        'status'  => false,
                        'request_url' => $this->_url,
                        'message' => 'Unknown api provider'
                    ));
                break; 
        }    
        // return $this->_getRequest($this->_url);
        return $this->_postRequest($this->_url);
    }


    private function _template($template = null, $data = array())
    {
        $newStr = $template;
        foreach ($data as $key => $value) {
            $newStr = str_replace("%$key%", $value, $template);
        }  
        return $newStr; 
    }


    /*
    *---------------------------------------------------------------
    * AVAILABLE SMS API
    *---------------------------------------------------------------
    * NOTE: Those function return api url
    */
    private function _budgetsms()
    { 
        $this->_data = array(
            'username' => $this->_username,
            'handle'   => $this->_api_key,
            'userid'   => $this->_password,
            'msg'      => $this->_message,
            'from'     => $this->_from,
            'to'       => $this->_to,
        );
        $this->_url = "https://api.budgetsms.net/testsms/?"; 
    }


    private function _nexmo()
    {      
        $this->_data = array(
            'api_key'   => $this->_api_key,
            'api_secret'   => $this->_password,
            'text'      => $this->_message,
            'from'     => $this->_from,
            'to'       => $this->_to,
        );   
        $this->_url = "https://rest.nexmo.com/sms/json?";   
    }


    private function _clickatell()
    {
        $this->_data = array(
            'apiKey'   => $this->_api_key,
            'content'  => $this->_message,
            'from'     => $this->_from,
            'to'       => $this->_to,
        );   
        $this->_url = "https://platform.clickatell.com/messages/http/send?"; 
    }


    private function _robi()
    {
        $this->_data = array(
            'apiKey'   => $this->_api_key,
            'Username' => $this->_username,
            'Password' => $this->_password,
            'Message'  => $this->_message,
            'From'     => $this->_from,
            'To'       => $this->_to,
        );   
        $this->_url = "http://bmpws.robi.com.bd/ApacheGearWS/SendTextMessage?";
    }


    /*
    *---------------------------------------------------------------
    * CURL RESPONSE
    *---------------------------------------------------------------
    * NOTE: Return response data 
    */
    private function _getRequest()
    {     
        $ch = curl_init($this->_url."".http_build_query($this->_data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));   
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_ENCODING, "gzip");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSLVERSION,3);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        $response = curl_exec($ch);    
        if(curl_errno($ch)) 
        {      
            return json_encode(array(
                'status'      => false,
                'request_url' => $this->_url,
                'message'     => 'Curl error: ' . curl_error($ch)
            ));
        } else {    
            return json_encode(array(
                'status'      => true,
                'request_url' => $this->_url,
                'message'     => "success: ". $response
            ));  
        }   
        curl_close($ch);    
    }


    private function _postRequest()
    { 
        $ch = curl_init($this->_url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($this->_data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);    
        if(curl_errno($ch)) 
        {      
            return json_encode(array(
                'status'      => false,
                'message'     => 'Curl error: ' . curl_error($ch)
            ));
        } else {    
            return json_encode(array(
                'status'      => true,
                'message'     => "success: ". $response
            ));  
        }   
        curl_close($ch);    
    }
}



// $obj = new SMS_lib;
// $data = $obj->provider("budgetsms")
//             ->api_key("b39edd600577b6b3bd16cc69aec82f05")
//             ->username("yungong")
//             ->password("13906")
//             ->from("BdTask")
//             ->to(8801821742285)
//             ->message("Hello %mr_x%. Your email is : %email%. Thank you", array('mr_x'=>'Mr. X','email'=>'xyz@example.com'))
//             ->response();
// echo "<pre>";
// $data = json_decode($data, true);
// print_r($data);
// echo "</pre>";