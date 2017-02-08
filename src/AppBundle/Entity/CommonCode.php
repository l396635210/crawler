<?php

namespace AppBundle\Entity;

class CommonCode{

    const TENDER_UPDATE         = 1001;
    const COMPANY_UPDATE        = 1002;

    const TIMER_FIRST_CRAWL_TENDER    = 2;
    const TIMER_SECOND_CRAWL_TENDER   = 8;
    const TIMER_LOCAL_CRAWL_TENDER    = 13;

    const TIMER_SEND_TENDER_MAIL      = 4;
    const TIMER_SEND_TENDER_MAIL2     = 9;
    const TIMER_LOCAL_TENDER_MAIL     = 14;

    const TIMER_SEND_ADMIN_MAIL       = 4;
    const TIMER_SEND_ADMIN_MAIL2      = 9;

    const TIMER_BUSINESS_FIRST_PUSH = 10;
    const BUSINESS_PUSH_TIMES = 12;

    const AppBundle_Company = "AppBundle:Company";
    const AppBundle_Site = "AppBundle:Site";
    const ZhanhuiBundle_Channel = "ZhanhuiBundle:Channel";
    const QABundle_QAList = "QABundle:QAList";

    public static function timerBusinessLastPush(){
        return self::TIMER_BUSINESS_FIRST_PUSH + self::BUSINESS_PUSH_TIMES;
    }

}