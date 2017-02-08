<?php

namespace CompaniesBundle\Controller;

use AppBundle\Service\LogTool;
use CompaniesBundle\Entity\Tcompany;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Role\Role;
use AppBundle\Service\DomGrab;
use Symfony\Component\Validator\Constraints\DateTime;

class TcompanyController extends Controller
{

    /**
     * @Route("/super/oc/company/push/api", name="tcompany_push_api")
     */
    public function pushTestAction(Request $request)
    {
        set_time_limit(6000);
        $logTool = new LogTool('applog', $this->get('kernel')->getRootDir(), 'oil-companies');
        #$site = 'http://yp.pecans.cn/api/tender_company'; #测试服务器
        $site = "http://chain.oilsns.com/api/tender_company"; #正式服务器
        $domGrab = new DomGrab();
        $domGrab->setCURLParameters(array('timeout' => 60, 'headers' => [
            'User-Agent' =>  'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36',
            'Accept'     =>  'text/html,application/xhtml+xml,application/xml;',
        ]));

        $logTool->addInfo('开始推送石油链---渠道');

        if($request->request->get('company') && $request->request->get('company')->getId()){
            $list[0] = $request->request->get('company');
        }else{
            $repository = $this->getDoctrine()->getRepository("AppBundle:Company");
            $request->request->set('isPush', true);
            $list = $repository->findBy([
                'pushStatus' => false,
                'createDate' => new \DateTime(),
            ]);
            //$list = $repository->findAll();
        }

        $em = $this->getDoctrine()->getManager();

        $res = true;
        try{
            foreach($list as $item){
                $data  = array(
                    'id' => $item->getId(),
                    'country_id'    => $item->getCountryId(),
                    'name'          => $item->getCompanyName(),
                    'url'           => substr($item->getCompanySite(),0,499),
                    'status'        => $item->getStatus(),
                    'with_agent'    => $item->getWithAgent() ? 1 : 0,
                );

                ksort($data);
                $singstr = implode('-',$data);
                $token = md5($singstr.'Oil.Tender');

                $_request = array(
                    'token'=>$token,
                    'data' => json_encode( $data )
                );
                //var_dump(json_decode($_request));
                $domGrab->request('POST', $site, $_request );
                $logTool->addInfo('推送石油链--渠道:'.$item->getCompanyName());
                $res = $domGrab->getResponse()->getContent();

                $res = \GuzzleHttp\json_decode($res);

                if($res->Result==true) {
                    $item->setPushStatus(true);
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
