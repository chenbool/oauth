<?php
namespace extend\oauth;
/**
 * bool
 * 30024167@qq.com
 * oschina oauth登陆
 * https://www.oschina.net/openapi
 */
class Oschina
{
    protected $url              =   'https://www.oschina.net/action/openapi/';
	protected $client_id		=	'ada13e081d010bde17';
	protected $client_secret	=	'45a66fafbf43c5769fa';
    protected $redirect_uri     =   'http://www.hengtonghui.cn';

	function __construct(){
	}

	// 快捷方法 直接登陆
	public function login($code){
		$url = $this->get_access_token($code);
		return $this->get_userinfo($token);
	}

	// 第一步:获取 access_token 地址
	public function get_access_token($code){
        $url = $this->url."token?grant_type=authorization_code&code={$code}&client_id={$this->client_id}&redirect_uri={$redirect_uri}&client_secret={$this->client_secret}";
		return $this->curl_post($url);
	}

	// 第二步:获取用户信息
	public function get_userinfo($token){
        $url = $this->url.'action/openapi/user?access_token'=.$token;
		return json_decode( $this->curl_get($url), true);
	}

	// curl发送get请求
    public function curl_get($url=''){
    	
        $ch = curl_init();
        //设置选项，包括URL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //不验证证书
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); //不验证证书
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);

        //执行并获取HTML文档内容
        $output = curl_exec($ch);

        //释放curl句柄
        curl_close($ch);

        return $output;
    }

	// curl发送get请求
    public function curl_post($url=''){
    	
        $ch = curl_init();
        //设置选项，包括URL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //不验证证书
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); //不验证证书
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);

        //执行并获取HTML文档内容
        $output = curl_exec($ch);

        //释放curl句柄
        curl_close($ch);

        return $output;
    }


}

/* 
	//使用案例

	use extend\oauth\Oschina;
	$oschina = new Oschina();
	$oschina->login($code);

 */