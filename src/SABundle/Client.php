<?php

namespace SABundle;

use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Goutte\Client as BaseClient;

class Client extends BaseClient
{
    private $confCURL = [
        'timeout' => 120,
        'headers' => [
            'User-Agent' =>  'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36',
            'Accept'     =>  'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
            'CLIENT-IP'  =>  '58.68.44.61',
            'X-FORWARDED-FOR' => '58.68.44.61',
        ],
        'verify'=>false,
    ];

    public function setCURL($params){
        foreach ( $params as $key=>$val ){
            $this->confCURL[$key] = $val;
        }
        return $this;
    }

    public function setCookie($cookieString){
        if($cookieString){
            $cookies = explode(";", $cookieString);
            foreach ($cookies as $cookie){
                $this->getCookieJar()->set(Cookie::fromString(trim($cookie)));
            }
            $this->confCURL["headers"]["Cookie"] = $cookieString;
        }
        return $this;
    }

    public function setCURLParameters($parameters){
        $this->setCURL($parameters);
        $guzzleClient = new \GuzzleHttp\Client($this->confCURL);
        $this->setClient($guzzleClient);
        return $this;
    }

    public function setHeaders($name, $val){
        $this->confCURL["headers"][$name] = $val;
        return $this;
    }
}
