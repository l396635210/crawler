<?php

namespace CompaniesBundle\Controller;

use AppBundle\Entity\Tenders;
use AppBundle\Service\LogTool;
use CompaniesBundle\Entity\Titem;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Role\Role;
use AppBundle\Service\DomGrab;

class TitemController extends Controller
{
    /**
     * @Route("/super/oc/item/push", name="titem_push")
     */
    public function pushAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager('companies');
        $tendersRepository = $this->getDoctrine()->getRepository("AppBundle:Tenders");
        $list = $tendersRepository->findBy([
            'date' => new \DateTime()
        ]);
        foreach($list as $item){
            $tItem = new Titem();
            $tItem->setTitle($item->getTitle());
            $tItem->setCompanyId($item->getCompanyId());
            $tItem->setUrl($item->getUrl());
            $tItem->setDate($item->getDate());
            $em->persist($tItem);
        }

        $em->flush();

        $response['data'] = true;
        $serializer = $this->get('serializer');
        $response = $serializer->serialize($response, 'json');
        return new JsonResponse($response);
    }

    /**
     * @Route("/super/oc/item/push/api", name="titem_push_api")
     */
    public function pushTestAction(Request $request)
    {
        set_time_limit(6000);
        $logTool = new LogTool('applog', $this->get('kernel')->getRootDir(), 'oil-companies');
        #$site = 'http://yp.pecans.cn/index.php/Home/api/tender_item'; #测试服务器
        $site = "http://chain.oilsns.com/api/tender_item"; #正式服务器
        $domGrab = new DomGrab();
        $domGrab->setCURLParameters(array('timeout' => 60, 'headers' => [
            'User-Agent' =>  'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36',
            'Accept'     =>  'text/html,application/xhtml+xml,application/xml;',
        ]));
        $logTool->addInfo('开始推送石油链');
        $tendersRepository = $this->getDoctrine()->getRepository("AppBundle:Tenders");
        $request->request->set('isPush', true);
        $request->request->set('status', Tenders::VALID);
        $request->request->set('c.aid', ["logic"=>"<>", "val"=>"10"]);
        $list = $tendersRepository->findForPush($request);

        /*
        $list = $tendersRepository->findBy([
            'date' => new \DateTime('now'),
        ]);
        */
        $em = $this->getDoctrine()->getManager();

        $res = true;
        try{
            foreach($list as $item){
                $data  = array(
                    'id' => $item->getId(),
                    'company_id'    => $item->getCompanyId(),
                    'tender_no'     => $item->getCode(),
                    'title'         => $item->getTitle(),
                    'url'           => $item->getUrl(),
                    'update_date'   => $item->getDate()->format('Y-m-d'),
                    'end_date'      => $item->getFilterCloseDate() ? $item->getFilterCloseDate() : "",
                    'description'   => '',   // 简介，目前不用抓取，预留以后使用
                    'attachment'    => '',    // 附件，目前不用抓取，预留以后使用
                );
                ksort($data);
                $singstr = implode('-',$data);
                $token = md5($singstr.'Oil.Tender');

                $_request = array(
                    'token'=>$token,
                    'data' => json_encode( $data )
                );

                $domGrab->request('POST', $site, $_request );
                $logTool->addInfo('推送石油链:'.$item->getTitle());
                $res = $domGrab->getResponse()->getContent();
                $res = \GuzzleHttp\json_decode($res);

                if($res->Result==true) {
                    $item->setStatus(2);
                    $em->persist($item);
                    $em->flush();
                    $logTool->addInfo("推送成功");
                }else{
                    $logTool->addAlert($res->Message);
                }

            }
        }catch(\Exception $e){
            $logTool->addWarning($e);
        }

        $logTool->addInfo('推送结束！');
        return $this->redirectToRoute('admin');
    }

}
