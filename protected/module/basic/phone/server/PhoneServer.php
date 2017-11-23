<?php
/**
 * User: fu
 * Date: 2017/10/13
 * Time: 1:51
 */

namespace module\basic\phone\server;


use CC\db\base\select\ItemModel;
use CErrorException;

class PhoneServer
{
    public static function sendMsg($mobile,$text)
    {
        $url = 'https://sms.yunpian.com/v2/sms/single_send.json';
        $apikey = 'c55b480e75f882cccabb385dc6fc8998';
        $text = "【灏维网络】".$text;
        $params = [
            'apikey' => $apikey,
            'mobile' => $mobile,
            'text' => $text,
        ];
        $rs = \Curl::instance()->post($url,$params);
        $r = json_decode($rs,true);

        if($r['code']!= 0){
            \CC::log(['url' => $url,'params' => $params,'rs' => $rs],'phone_err');
            throw new CErrorException('短信发送失败：'.$r['msg']);
        }
        return true;
    }

    public static function sendMsg2()
    {
        $sms = new SmsApi("LTAIaARN1CpPFU3S", "your access key secret"); // 请参阅 https://ak-console.aliyun.com/ 获取AK信息

        $response = $sms->sendSms(
            "短信签名", // 短信签名
            "SMS_0000001", // 短信模板编号
            "12345678901", // 短信接收者
            Array (  // 短信模板中字段的值
                "code"=>"12345",
                "product"=>"dsd"
            ),
            "123"   // 流水号,选填
        );
        echo "发送短信(sendSms)接口返回的结果:\n";
        print_r($response);

        sleep(2);

        $response = $sms->queryDetails(
            "12345678901",  // 手机号码
            "20170718", // 发送时间
            10, // 分页大小
            1 // 当前页码
            // "abcd" // bizId 短信发送流水号，选填
        );
        echo "查询短信发送情况(queryDetails)接口返回的结果:\n";
        print_r($response);
    }

    public static function checkCode($phone,$code )
    {
        $item = ItemModel::make('phone_code')->addColumnsCondition(array(
            'phone' => $phone,
            'c_time' => ['>',time() - 60 * 10],
        ))->order('id desc')->execute();
        if($item['code'] != $code){
            throw new CErrorException('验证码错误');
        }
    }
}



/**
 * 签名助手 2017/11/19
 *
 * Class SignatureHelper
 */
class SignatureHelper {

    /**
     * 生成签名并发起请求
     *
     * @param $accessKeyId string AccessKeyId (https://ak-console.aliyun.com/)
     * @param $accessKeySecret string AccessKeySecret
     * @param $domain string API接口所在域名
     * @param $params array API具体参数
     * @return bool|\stdClass 返回API接口调用结果，当发生错误时返回false
     */
    public function request($accessKeyId, $accessKeySecret, $domain, $params) {
        $apiParams = array_merge(array (
            "SignatureMethod" => "HMAC-SHA1",
            "SignatureNonce" => uniqid(mt_rand(0,0xffff), true),
            "SignatureVersion" => "1.0",
            "AccessKeyId" => $accessKeyId,
            "Timestamp" => gmdate("Y-m-d\TH:i:s\Z"),
            "Format" => "JSON",
        ), $params);
        ksort($apiParams);

        $sortedQueryStringTmp = "";
        foreach ($apiParams as $key => $value) {
            $sortedQueryStringTmp .= "&" . $this->encode($key) . "=" . $this->encode($value);
        }

        $stringToSign = "GET&%2F&" . $this->encode(substr($sortedQueryStringTmp, 1));

        $sign = base64_encode(hash_hmac("sha1", $stringToSign, $accessKeySecret . "&",true));

        $signature = $this->encode($sign);

        $url = "http://{$domain}/?Signature={$signature}{$sortedQueryStringTmp}";

        try {
            $content = $this->fetchContent($url);
            return json_decode($content);
        } catch( \Exception $e) {
            return false;
        }
    }

    private function encode($str)
    {
        $res = urlencode($str);
        $res = preg_replace("/\+/", "%20", $res);
        $res = preg_replace("/\*/", "%2A", $res);
        $res = preg_replace("/%7E/", "~", $res);
        return $res;
    }

    private function fetchContent($url) {
        if(function_exists("curl_init")) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "x-sdk-client" => "php/2.0.0"
            ));
            $rtn = curl_exec($ch);

            if($rtn === false) {
                trigger_error("[CURL_" . curl_errno($ch) . "]: " . curl_error($ch), E_USER_ERROR);
            }
            curl_close($ch);

            return $rtn;
        }

        $context = stream_context_create(array(
            "http" => array(
                "method" => "GET",
                "header" => array("x-sdk-client: php/2.0.0"),
            )
        ));

        return file_get_contents($url, false, $context);
    }
}


class SmsApi {

    private $accessKeyId;
    private $accessKeySecret;

    /**
     * SmsApi 构造函数.
     * @param $accessKeyId string AccessKeyId，请参阅<a href="https://ak-console.aliyun.com/">阿里云Access Key管理</a>
     * @param $accessKeySecret string AccessKeySecret，请参阅<a href="https://ak-console.aliyun.com/">阿里云Access Key管理</a>
     */
    function  __construct($accessKeyId, $accessKeySecret) {
        $this->accessKeyId = $accessKeyId;
        $this->accessKeySecret = $accessKeySecret;
    }

    /**
     * 发送短信
     *
     * @param string $signName <p>
     * 必填, 短信签名，应严格"签名名称"填写，参考：<a href="https://dysms.console.aliyun.com/dysms.htm#/sign">短信签名页</a>
     * </p>
     * @param string $templateCode <p>
     * 必填, 短信模板Code，应严格按"模板CODE"填写, 参考：<a href="https://dysms.console.aliyun.com/dysms.htm#/template">短信模板页</a>
     * (e.g. SMS_0001)
     * </p>
     * @param string $phoneNumbers 必填, 短信接收号码 (e.g. 12345678901)
     * @param array|null $templateParam <p>
     * 选填, 假如模板中存在变量需要替换则为必填项 (e.g. Array("code"=>"12345", "product"=>"阿里通信"))
     * </p>
     * @param string|null $outId [optional] 选填, 发送短信流水号 (e.g. 1234)
     * @param string|null $smsUpExtendCode [optional] 选填，上行短信扩展码（扩展码字段控制在7位或以下，无特殊需求用户请忽略此字段）
     * @return \stdClass
     */
    public function sendSms($signName, $templateCode, $phoneNumbers, $templateParam = null, $outId = null, $smsUpExtendCode = null) {

        // 初始化SendSmsRequest实例用于设置发送短信的参数
        $helper = new SignatureHelper();

        $params = array (
            "RegionId" => "cn-hangzhou",
            "Action" => "SendSms",
            "Version" => "2017-05-25",
            "PhoneNumbers" => $phoneNumbers,
            "SignName" => $signName,
            "TemplateCode" => $templateCode,
        );


        // 可选，设置模板参数
        if($templateParam) {
            $params['TemplateParam'] = json_encode($templateParam);
        }

        // 可选，设置流水号
        if($outId) {
            $params['OutId'] = $outId;
        }

        // 选填，上行短信扩展码
        if($smsUpExtendCode) {
            $params['SmsUpExtendCode'] = $smsUpExtendCode;
        }

        $content = $helper->request(
            $this->accessKeyId,
            $this->accessKeySecret,
            "dysmsapi.aliyuncs.com",
            $params
        );

        return $content;
    }


    /**
     * 短信发送记录查询
     *
     * @param string $phoneNumbers 必填, 短信接收号码 (e.g. 12345678901)
     * @param string $sendDate 必填，短信发送日期，格式Ymd，支持近30天记录查询 (e.g. 20170710)
     * @param int $pageSize 必填，分页大小
     * @param int $currentPage 必填，当前页码
     * @param string $bizId 选填，短信发送流水号 (e.g. abc123)
     * @return \stdClass
     */
    public function queryDetails($phoneNumbers, $sendDate, $pageSize = 10, $currentPage = 1, $bizId=null) {

        // 初始化SendSmsRequest实例用于设置发送短信的参数
        $helper = new SignatureHelper();

        $params = array (
            "RegionId" => "cn-hangzhou",
            "Action" => "QuerySendDetails",
            "Version" => "2017-05-25",
            "PhoneNumber" => $phoneNumbers,
            "SendDate" => $sendDate,
            "PageSize" => $pageSize,
            "CurrentPage" => $currentPage,
        );

        // 可选，设置流水号
        if($bizId) {
            $params['BizId'] = $bizId;
        }

        $content = $helper->request(
            $this->accessKeyId,
            $this->accessKeySecret,
            "dysmsapi.aliyuncs.com",
            $params
        );

        return $content;
    }
}