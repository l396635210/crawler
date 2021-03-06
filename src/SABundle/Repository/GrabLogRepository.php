<?php

namespace SABundle\Repository;
use SABundle\Entity\GrabLog;
use SABundle\Entity\GrabRule;
use Symfony\Component\HttpFoundation\Request;

/**
 * GrabLogRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class GrabLogRepository extends \Doctrine\ORM\EntityRepository
{
    public function setGrabLog(GrabRule $grabRule){
        $grabLog = new GrabLog();
        $grabLog->setGrabRule($grabRule);
        $grabLog->setIsSuccess(true);
        $grabLog->setCreateDate(new \DateTime());
        $grabLog->setCreateTime(new \DateTime());
        return $grabLog;
    }

}
