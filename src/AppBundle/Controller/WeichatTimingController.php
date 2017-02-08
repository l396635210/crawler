<?php

namespace AppBundle\Controller;

use AppBundle\Service\DomGrab;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Role\Role;

class WeichatTimingController extends Controller
{
    /**
     * @Route("/admin/weichat/send", name="weichat_send")
     */
    public function sendAction(Request $request)
    {
        $domGrab = new DomGrab();

        $params = 'msg_type=text&content=大家好&appmsg_id=0&image=0&image_material=0&voice_id=0&video_id=0&send_type=0&group_id=0&send_openids=&preview_openids=&token=gh_55d4cfc33301';

        $crawler = $domGrab->request('POST'
            ,'http://31fe7c66.ngrok.natapp.cn/weiphp/index.php?s=/Home/Message/add/model/18/mdm/45|50.html'
            , [], [], ['HTTP_CONTENT_TYPE' => 'application/x-www-form-urlencoded'], $params);

        dump($crawler);die;
        // replace this example code with whatever you need
        return $this->render('area/list.html.twig', array(
            'active' => $request->get('_route'),
            'list' => $list,
        ));
    }

    /**
     * @Route("/admin/test1", name="test1")
     */
    public function testAction(Request $request)
    {

        $res = $this->http('https://sourcing.essar.com/tender/USER/Tender_Download.aspx?id=1');
dump($res);die;

        // replace this example code with whatever you need
        return $this->render('area/list.html.twig', array(
            'active' => $request->get('_route'),
            'list' => $list,
        ));
    }


    /**
     * 发送HTTP请求方法
     * 当POST请求时 $header 为 application/x-www-form-urlencoded
     * @param  string $url    请求URL
     * @param  array  $params 请求参数
     * @param  string $method 请求方法GET/POST
     * @return array  $data   响应数据
     */
    function http($url, $params=[], $method = 'GET', $header = array(), $multi = false){
        $opts = array(
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_HTTPHEADER     => $header,
            CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1 ,
        );

        /* 根据请求类型设置特定参数 */
        switch(strtoupper($method)){
            case 'GET':
                $opts[CURLOPT_URL] = $url . '?' . http_build_query($params);
                break;
            case 'POST':
                //判断是否传输文件
                $params = $multi ? $params : http_build_query($params);
                $opts[CURLOPT_URL] = $url;
                $opts[CURLOPT_POST] = 1;
                $opts[CURLOPT_SAFE_UPLOAD] = false; //  PHP 5.6.0 后必须开启
                $opts[CURLOPT_POSTFIELDS] = $params;
                break;
            default:
                throw new Exception('不支持的请求方式！');
        }
        $opts[CURLOPT_USERAGENT] = 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36';
        /* 初始化并执行curl请求 */
        $ch = curl_init();
        curl_setopt_array($ch, $opts);

        $data  = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);
        if($error) throw new \Exception('请求发生错误：' . $error);
        return  $data;
    }

}
