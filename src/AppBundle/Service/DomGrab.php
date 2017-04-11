<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/16
 * Time: 20:26
 *
 * Method:getNode(0):獲得選擇元素的Dom對象
 */
namespace AppBundle\Service;

use Symfony\Component\DomCrawler\Crawler;
use Goutte\Client;
use Symfony\Component\BrowserKit\Cookie;

class DomGrab extends Client{

    protected $skipForReduce;
    protected $choiceForReduce;

    public function setCURLParameters($parameters){
        $guzzleClient = new \GuzzleHttp\Client($parameters);
        $this->setClient($guzzleClient);
    }

    public function parseRules(Crawler $crawler, $rules){

        if(json_decode($rules, true)){
            $res = $this->parseRulesByJson($crawler, $rules);
        }else if( strpos( $rules,  '|' ) ){
            $rules = explode('|', $rules);
            list($filter, $eq) = array($rules[0], count($rules)==2?$rules[1]:0 );
            $res =  $crawler->filter($filter)->eq($eq);
        }else{
            $res = $crawler->filter($rules);
        }
        return $res;
    }

    public function parseRulesByJson(Crawler $crawler, $rules){

        $rules = \GuzzleHttp\json_decode($rules, true);
        foreach( $rules as $function=>$params ){
            $params = explode(",", $params);

            if($function=='reduce'){
                $crawler = $this->myReduce($crawler, $params);
                continue;
            }
            if($function=='remove'){
                $crawler = $this->remove($crawler,$params);
                continue;
            }

            if( !$params )
                $crawler = $crawler->$function();
            if(count($params)==1)
                $crawler = $crawler->$function($params[0]);
            if(count($params)==2)
                $crawler = $crawler->$function($params[0], $params[1]);
            if(count($params)==3)
                $crawler = $crawler->$function($params[0], $params[1], $params[2]);

        }
        return $crawler;
    }

    /**
     * 调用Crawler的reduce方法
     * @param Crawler $crawler
     * @param $params array(规则:int，去:0留:1,default:1)
     * @return Crawler
     */
    public function myReduce(Crawler $crawler, $params){

        $this->skipForReduce = $params[0];
        $this->choiceForReduce = count($params)==2 ? $params[1] : true;
        return $crawler->reduce(function(Crawler $node, $i){
            if($this->choiceForReduce)
                return ($i % $this->skipForReduce) == 0;
            return ($i % $this->skipForReduce) != 0;
        });
    }

    /**
     * 移除節點
     * @param Crawler $crawler
     * @param $rule
     */
    protected function remove(Crawler $crawler, $params){
        $selector = $params[0];
        $num = isset($params[1]) ? $params[1] : 0;

        if($crawler->getNode(0) && $crawler->filter($selector)->getNode($num)){
            $crawler->getNode(0)->removeChild($crawler->filter($selector)->getNode($num));
        }
        return $crawler;
    }

    public function parseChoice(Crawler $crawler, $rules, $isDesc=false){
        $crawler = $this->parseRules($crawler, $rules);
        if($isDesc==true){
            $reversNodes = array_reverse($crawler->getIterator()->getArrayCopy());
            $crawler->clear();
            $crawler->addNodes($reversNodes);
        }
        return $crawler;
        //->slice(0,20)
    }

    public function parseLink(Crawler $crawler, $rules){
        if($this->parseRules($crawler, $rules)->getNode(0)){
            $link = trim($this->parseRules($crawler, $rules)->text());
            return preg_replace("/\s\s+/", " ", $link);
        }
    }

    public function parseTitle(Crawler $crawler, $rules){
        if($this->parseRules($crawler, $rules)->getNode(0)) {
            $title = trim($this->parseRules($crawler, $rules)->text());
            return preg_replace("/\s\s+/", " ", $title);
        }
    }

    public function parseContent(Crawler $crawler, $rules){
        if($this->parseRules($crawler, $rules)->getNode(0)) {
            $title = trim($this->parseRules($crawler, $rules)->text());
            return preg_replace("/(\t\t+|\&nbsp\;|　|\xc2\xa0
                |\xF4\x80\x81\xB9
                |\xF4\x80\x82\x84)/", " ", $title);
        }
    }

    public function getUri(Crawler $crawler, Crawler $node,$rules, $k=0, $isDesc=false){

        $link = $this->parseLink($node, $rules);
        $links = $crawler->selectLink( preg_replace("/\s\s+/", " ", $link) )->links();

        if($isDesc){
            $k = count($links) - $k - 1;
        }
        //2016年10月8日 12:09:35 修改
        //2016年10月9日 11:37:05 版本2
        if($rules=="a"){
            #$host = $this->getRequest()->getServer()['HTTP_HOST'];
            $href = $node->filter($rules)->attr("href");
            #$uri = strstr($href,$host)||strstr($href,"http://") ? $href : $host."/$href";

            return $href;
        }//end

        if(strstr($rules,"img")){
            #$host = $this->getRequest()->getServer()['HTTP_HOST'];
            $href = $node->filter($rules)->attr("src");
            #$uri = strstr($href,$host)||strstr($href,"http://") ? $href : $host."/$href";

            return $href;
        }//end

        if(isset($links[$k])){
            $uri = $links[$k]->getUri();
        }else{
            $uri = $crawler->selectLink( preg_replace("/\s\s+/", " ", $link) )->link()->getUri();
        }

        return $uri;
    }

    /**
     * @param array $cookies
     */
    public function setCookie($cookies){
        if($cookies){
            foreach($cookies as $key=>$val ){
                if(is_string($val)){
                    $cookie = new Cookie($key, $val);
                }
                if(is_array($val)){
                    $cookie = new Cookie($key, $val['val'], NULL, NULL, $val['domain']);
                }

                $this->getCookieJar()->set($cookie);
            }
        }
        die;
    }

    public function getTendersCount($site, $rule){
        $crawler = $this->request('GET', $site);
        $crawler = $this->request('POST', $site);
dump($this->getCookieJar());die;
        $count = $this->parseChoice($crawler, $rule)->count();

        if(!$count){
            $crawler = $this->request('POST', $site);
            $count = $this->parseChoice($crawler, $rule)->count();
        }
        //去除script标签
        $crawler->filter('style')->each(function (Crawler $node, $i) {
            $node->getNode(0)->parentNode->removeChild($node->getNode(0));
        });
        $crawler->filter('script')->each(function (Crawler $node, $i) {
            $node->getNode(0)->parentNode->removeChild($node->getNode(0));
        });
        return [
            'count'=>$count,
            'crawler' => $crawler,
        ];
    }


}