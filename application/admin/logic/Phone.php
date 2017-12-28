<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/11/16
 * Time: 18:37
 */

namespace app\admin\logic;


class Phone
{
    public static function sendMsg($mobile,$text)
    {
        $url = 'https://sms.yunpian.com/v2/sms/single_send.json';
        $apikey = 'c55b480e75f882cccabb385dc6fc8998';
        $text = "【灏维网络】".$text;
        $r = Curl::instance()->post($url,array(
            'apikey' => $apikey,
            'mobile' => $mobile,
            'text' => $text,
        ));
        $r = json_decode($r,true);

        if($r['code']!= 0){
            return false;
        }
        return true;
    }

}


class Curl {

    private $_ch;
    public $options;
    private $_cookieFile;
    public $url;
    private $_config = array(
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_AUTOREFERER => true,
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_TIMEOUT => 10,
        CURLOPT_SSL_VERIFYPEER => false,
    );
    private static $request_record = array();
    private $request_info = array();
    public function setCookieFile($filename,$dir = null)
    {
        if($dir === null){
            $dir = dirname(__FILE__).'/tmp';
        }
        $this->_cookieFile = $dir.'/'.$filename;
    }
    public function getCookieFile()
    {
        if($this->_cookieFile == null){
            $this->_cookieFile = tempnam(dirname(__FILE__).'/tmp','COOKIE_');
        }
        return $this->_cookieFile;
    }
    private function _exec($url,$params = '') {
        $this->url = $url;
        $this->setOption(CURLOPT_URL, $url);
        $start_time = microtime(true);
        $this->request_info = array(
            'url' => $url,
            'params' => $params,
            'exec_time' => 0,
            'result' => '',
        );
        $c = curl_exec($this->_ch);
        $this->request_info['exec_time'] = number_format(microtime(true) - $start_time,6);
        $this->request_info['result'] = $c;
        self::$request_record[] = $this->request_info;
        $curl_errno = curl_errno($this->_ch);
        if (!$curl_errno)
            return $c;
        else
        {
            $err = curl_error($this->_ch);
            throw new Exception($err.'('.$curl_errno.')',$this->getRequestInfo());
        }
    }

    public static function getAllRequestRecord($is_string = false)
    {
        if($is_string){
            $msg = '';
            foreach (self::$request_record as $data) {
                $msg .= "\n\n" . 'url:     ' . $data['url'] . "\n";
                $msg .= 'params:  ' . $data['params'] . "\n";
                $msg .= 'line:  ' . $data['line'] . "\n";
                $msg .= 'exec_time:  ' . $data['exec_time'] . "\n\n";
            }
            return $msg;
        }
        return self::$request_record;
    }
    public function get($url, $params = array()) {
        $this->setOption(CURLOPT_HTTPGET, true);
        $r =  $this->_exec($this->buildUrl($url, $params));
        return $r;
    }

    public function post($url, $params = array()) {
        if(is_array($params)){
            $has_file = false;
            foreach ($params as $name => $value) {
                if(is_object($value)){
                    $has_file = true;
                    break;
                }
            }
            if(!$has_file){
                $params = http_build_query($params);
            }
        }
        $this->setOption(CURLOPT_POST, true);
        $this->setOption(CURLOPT_POSTFIELDS, $params);
        $r =  $this->_exec($url,$params);
        return $r;
    }
    public function postMulti($urls,$fn)
    {
        $mh = curl_multi_init();
        $curl_handles = array();
        foreach ($urls as $data) {
            $ch = $this->_init_multi();
            if(isset($data['params'])){
                if(is_array($data['params'])){
                    $data['params'] = http_build_query($data['params']);
                }
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data['params']);
            }
            curl_setopt($ch, CURLOPT_URL, $data['url']);
            curl_setopt($ch, CURLOPT_POST, true);
            $curl_handles[] = array('url' => $data['url'],'ch' => $ch);
            curl_multi_add_handle($mh, $ch);
        }
        $active = null;
        do {
            $mrc = curl_multi_exec($mh, $active);
        }
        while ($mrc == CURLM_CALL_MULTI_PERFORM);

        while ($active && $mrc == CURLM_OK) {
            if (curl_multi_select($mh) != -1) {
                do {
                    $mrc = curl_multi_exec($mh, $active);
                }
                while ($mrc == CURLM_CALL_MULTI_PERFORM);
            }
        }

        foreach ($curl_handles as $val) {
            $html = curl_multi_getcontent($val['ch']);
            call_user_func($fn,$html,$val['url']);
            curl_multi_remove_handle($mh, $val['ch']);
        }
        curl_multi_close($mh);
    }
    public function getMulti($urls,$fn)
    {
        $mh = curl_multi_init();
        $curl_handles = array();
        foreach ($urls as $data) {
            $ch = $this->_init_multi();
            $url = $data['url'];
            if(isset($data['params'])){
                $url = $this->buildUrl($data['url'], $data['params']);
            }
            curl_setopt($ch, CURLOPT_URL, $url);
            $curl_handles[] = array('url' => $url,'ch' => $ch);
            curl_multi_add_handle($mh, $ch);
        }
        $active = null;
        do {
            $mrc = curl_multi_exec($mh, $active);
        }
        while ($mrc == CURLM_CALL_MULTI_PERFORM);

        while ($active && $mrc == CURLM_OK) {
            if (curl_multi_select($mh) != -1) {
                do {
                    $mrc = curl_multi_exec($mh, $active);
                }
                while ($mrc == CURLM_CALL_MULTI_PERFORM);
            }
        }

        foreach ($curl_handles as $val) {
            $html = curl_multi_getcontent($val['ch']);
            call_user_func($fn,$html,$val['url']);
            curl_multi_remove_handle($mh, $val['ch']);
        }
        curl_multi_close($mh);
    }
    private function _init_multi()
    {
        $ch = curl_init();
        $options = is_array($this->options) ? ($this->options + $this->_config) : $this->_config;
        curl_setopt_array($ch, $options);
        return $ch;
    }
    private static $_curl ;
    public static function instance($options=array())
    {
        self::$_curl = new Curl();
        self::$_curl->options=$options;
        self::$_curl->init();
        return self::$_curl;

    }

    public function put($url, $data, $params = array()) {

        $f = fopen('php://temp', 'rw+');
        fwrite($f, $data);
        rewind($f);

        $this->setOption(CURLOPT_PUT, true);
        $this->setOption(CURLOPT_INFILE, $f);
        $this->setOption(CURLOPT_INFILESIZE, strlen($data));

        return $this->_exec($this->buildUrl($url, $params));
    }

    public function buildUrl($url, $data = array()) {
        $parsed = parse_url($url);
        isset($parsed['query']) ? parse_str($parsed['query'], $parsed['query']) : $parsed['query'] = array();
        $params = isset($parsed['query']) ? array_merge($parsed['query'], $data) : $data;
        $parsed['query'] = ($params) ? '?' . http_build_query($params) : '';
        if (!isset($parsed['path']))
            $parsed['path'] = '/';

        $port = '';
        if(isset($parsed['port'])){
            $port = ':' . $parsed['port'];
        }

        return $parsed['scheme'] . '://' . $parsed['host'] .$port. $parsed['path'] . $parsed['query'];
    }

    public function setOptions($options = array()) {
        curl_setopt_array($this->_ch, $options);
        return $this;
    }

    public function setOption($option, $value) {
        curl_setopt($this->_ch, $option, $value);
        return $this;
    }

    // sets header for current request
    public function setHeaders($header)
    {
        $out = array();
         foreach($header as $k => $v){
             $out[] = $k .': '.$v;
         }
        $header = $out;
        $this->setOption(CURLOPT_HTTPHEADER, $header);
        return $this;
    }


    // initialize curl
    public function init() {
        try {
            $this->_ch = curl_init();
            $options = is_array($this->options) ? ($this->options + $this->_config) : $this->_config;
            $this->setOptions($options);
        } catch (Exception $e) {
            throw new CurlException($e->getMessage(),$this->getRequestInfo());
        }
    }

    public function close()
    {
        $ch = $this->_ch;
        curl_close($ch);
    }

    /**
     * @return string
     */
    public function getRequestInfo()
    {
        return var_export($this->request_info,true);
    }

}
