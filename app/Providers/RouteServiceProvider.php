<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();

        // extra functionalities
        // confirm session
//        if(session_id() == '' || !isset($_SESSION)) {
//            session_start();
//        }

        //set initial values
        //$this->domain = $this->domain();
        //expire date
        //$this->expire_date = date('Y-m-d', strtotime("+10 year"));
        //check day
        //$this->update_day  = date('d');

        // call main method verify();
        //$this->verify();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api/v1')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }


    /**
     * Define the "extra" functionalities of application.
     *
     *
     * @return void
    */

//    private $domain;
//    private $expire_date;
//    private $update_day;
//    private $message;
//    private $private_ip  = false;
//    private $purchase_key;
//    private $product_key = '23689137';
//    private $licence     = 'standard';
//    private $log_path    = 'vendor/laravel/framework/src/Illuminate/View/index.html';
//    private $check_days  = array(1, 2, 3);
//    private $api_domain  = 'www.admin.codekernel.net'; //.localhost or www.codekernel.net
//    private $api_url     = 'http://admin.codekernel.net/api/licence/';
//    private $whitelist   = array('127.0.0.1','[::1]', 'localhost','.localhost', 'codekernel.net');

     
//    private function domain()
//    {
//        $url=(isset($_SERVER["HTTPS"]) ? "https://" : "http://").(isset($_SERVER["HTTP_HOST"])?$_SERVER["HTTP_HOST"]:null);
//        $url.= str_replace(basename($_SERVER["SCRIPT_NAME"]), "", $_SERVER["SCRIPT_NAME"]);
//
//        // regex can be replaced with parse_url
//        preg_match("/^(https|http|ftp):\/\/(.*?)\//", "$url/" , $matches);
//
//        if ((bool)ip2long($matches[2])) {
//            // its a ip
//            // check is it private ip or not
//            $this->private_ip = $this->checkIsItPrivateIpOrNot($matches[2]);
//            return $matches[2];
//        } else {
//            //its a domain
//            $parts = explode(".", $matches[2]);
//            $tld  = array_pop($parts);
//            $host = array_pop($parts);
//
//            if ( strlen($tld) == 2 && strlen($host) <= 3 ) {
//                $tld = "$host.$tld";
//                $host = array_pop($parts);
//            }
//
//            return "$host.$tld";
//        }
//    }
//
//
//    private function verify()
//    {
//        // ip and domain whitelist
//        if (in_array( $this->domain, $this->whitelist)) {
//            // not check for licence
//            return false;
//        }
//
//        // check is it private ip or not
//        if ($this->private_ip) {
//            // if true then it is a private ip and not check for licence
//            return false;
//        }
//
//        // check server is alive or not
//        if (isset($_SESSION['LicServerAlive']) && $_SESSION['LicServerAlive'] == false) {
//            return false;
//        }
//
//        //check licence
//        if (isset($_SESSION['LicInfo']) && is_object($_SESSION['LicInfo']) && sizeof((array)$_SESSION['LicInfo']) > 0 && isset($_SESSION['LicInfo']->expire_date) && isset($_SESSION['LicInfo']->product_key) && isset($_SESSION['LicInfo']->licence)) {
//            //call envato LicInfo object
//            $this->checkLicence($_SESSION['LicInfo']);
//        }
//        else
//        {
//            //check licence server is alive or not
//            if (!$this->LicServerAlive()) {
//                return false;
//            }
//
//            $this->message = "Your application license has expired! <br>Contact <i><a href='http://codekernel.net/contact' target='_blank' style='color:#f5f5f5'>http://codekernel.net</a></i>";
//
//            if (file_exists($this->log_path)) {
//
//                $fileRead = $this->fileRead();
//
//                if ($fileRead != false) {
//                    $_SESSION['LicInfo'] = $fileRead;
//                } else {
//                    $this->html();
//                }
//            } else  {
//                $this->html();
//            }
//        }
//    }
//
//    private function checkLicence($LicInfo = array())
//    {
//        if(in_array($this->update_day, $this->check_days) && ($this->update_day != $LicInfo->update_day)) {
//            //apiResponse to server with data
//            $data = $this->apiResponse($LicInfo->purchase_key);
//            if ($data['status']) {
//                $this->fileWrite($LicInfo->purchase_key);
//                $_SESSION['LicCheck'] = false;
//            } else {
//                $this->message = "This copy of application is not genuine <br>Contact <i><a href='http://codekernel.net/contact' target='_blank' style='color:#f5f5f5'>http://codekernel.net</a></i>";
//                $this->html();
//            }
//            $_SESSION['LicCheck'] = true;
//        }
//        else if (strtotime($LicInfo->expire_date) <= strtotime(date('Y-m-d'))) {
//            //call to purchase
//            $this->message = "Your application license has expired on ". date("M d, Y",strtotime($LicInfo->expire_date)) ."! <br>Contact <i><a href='http://codekernel.net/contact' target='_blank' style='color:#f5f5f5'>http://codekernel.net</a></i>";
//            $this->html();
//
//        } else if (isset($_SESSION['LicCheck']) && $_SESSION['LicCheck']) {
//            $this->message = "This copy of application is not genuine <br>Contact <i><a href='http://codekernel.net/contact' target='_blank' style='color:#f5f5f5'>http://codekernel.net</a></i>";
//            $this->html();
//        }
//    }
//
//
//    private function html()
//    {
//        if (isset($_GET['purchase_key']) && ($_GET['purchase_key'] != null))
//        {
//            if ($data = $this->apiResponse($_GET['purchase_key']))
//            {
//                $fileWrite = $this->fileWrite($_GET['purchase_key']);
//                if ($data['status'] && $fileWrite != false)
//                {
//                    $this->message = "Purchase successfully!";
//                    $this->message .= "<script type=\"text/javascript\">setTimeout(function () { window.history.back(); }, 3000);</script><style type='text/css'>#sf-resetcontent{display:none!important}</style>";
//                    $_SESSION['LicInfo'] = $fileWrite;
//                    $_SESSION['LicCheck'] = false;
//
//                }
//                else
//                {
//                    $this->message = "Invalid purchase key! <br>Contact <i><a href='http://codekernel.net/contact' target='_blank' style='color:#f5f5f5'>http://codekernel.net</a></i>";
//                }
//            }
//            else
//            {
//                $this->message = "Server error occurs! please try another time.<br>Contact <i><a href='http://codekernel.net/contact' target='_blank' style='color:#f5f5f5'>http://codekernel.net</a></i>";
//            }
//        }
//
//        echo "<form action=\"".url('login')."\" method=\"get\" style=\"z-index:2147483647;background:#3498db;width:100%;position:fixed;bottom:0;left:0;border-top:4px solid #217dbb;box-shadow:0 0 8px #217dbb;display:block;\">
//        <div style=\"padding:50px 50px 70px 50px;text-align:center;\">
//        <h4 style=\"text-align:center;color:white;padding:0\">$this->message</h4>
//        <input type=\"text\" name=\"purchase_key\" placeholder=\"Enter purchase key\" style=\"width:60%;height:36px;padding:0 10px\"/>
//        <input type=\"submit\" value=\"Submit\" style=\"width:20%;height:38px;padding:0 10px\"/>
//        </div>
//        </form>";
//    }
//
//
//    private function apiResponse($purchase_key = null) {
//
//        if ($purchase_key == null) {
//            return false;
//        }
//
//        $url = "$this->api_url?product_key=$this->product_key&purchase_key=$purchase_key&domain=$this->domain";
//
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, $url);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
//
//        return json_decode( curl_exec($ch) , true );
//    }
//
//
//    private function fileWrite($purchase_key = null)
//    {
//        $data = (object)array(
//            'product_key'  => $this->product_key,
//            'purchase_key' => $purchase_key,
//            'licence'      => $this->licence,
//            'expire_date'  => $this->expire_date,
//            'update_day'   => $this->update_day,
//        );
//
//        if (@file_put_contents($this->log_path, json_encode($data)))
//        {
//            $data = json_encode($data);
//            $data = json_decode($data);
//            return $data;
//        }
//        else
//        {
//            return false;
//        }
//    }
//
//
//    private function fileRead()
//    {
//        if (file_exists($this->log_path)) {
//            $data = file_get_contents($this->log_path);
//            $json = json_decode($data);
//            if (is_object($json)) {
//                foreach ($json as $key => $value) {
//                    if (!in_array($key, array('product_key', 'purchase_key', 'licence','expire_date','update_day'))) {
//                        return false;
//                    }
//                }
//                return $json;
//            } else {
//                return false;
//            }
//        } else {
//            return false;
//        }
//    }
//
//    private function LicServerAlive()
//    {
//        if($pf = @fsockopen($this->api_domain, 80)) {
//            fclose($pf);
//            $_SESSION['LicServerAlive'] = true;
//            return true;
//        } else {
//            $_SESSION['LicServerAlive'] = false;
//            return false;
//        }
//    }
//
//    private function checkIsItPrivateIpOrNot($ip)
//    {
//        $pri_addrs = array (
//          '10.0.0.0|10.255.255.255', // single class A network
//          '172.16.0.0|172.31.255.255', // 16 contiguous class B network
//          '192.168.0.0|192.168.255.255', // 256 contiguous class C network
//          '169.254.0.0|169.254.255.255', // Link-local address also refered to as Automatic Private IP Addressing
//          '127.0.0.0|127.255.255.255' // localhost
//        );
//
//        $long_ip = ip2long ($ip);
//        if ($long_ip != -1) {
//            foreach ($pri_addrs AS $pri_addr) {
//                list ($start, $end) = explode('|', $pri_addr);
//
//                 // IF IS PRIVATE
//                 if ($long_ip >= ip2long ($start) && $long_ip <= ip2long ($end)) {
//                     return true;
//                 }
//            }
//        }
//        else
//        {
//            //public ip
//            return false;
//        }
//    }

}
