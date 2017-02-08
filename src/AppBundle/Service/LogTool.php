<?php

namespace AppBundle\Service;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

class LogTool extends Logger{

    public function __construct($name, $root, $fileName = 'app_logs', array $handlers = array(), array $processors = array())
    {
        parent::__construct($name, $handlers, $processors);
        $file = strtolower(php_sapi_name())=="cli"
            ? $root.'/../var/logs'.date('/Y/m/d').'/'.$fileName.'.log'
            : $root.'/logs'.date('/Y/m/d').'/'.$fileName.'.log';
        $this->pushHandler(new StreamHandler($file, Logger::DEBUG,true, 0777 ));
        $this->pushHandler(new FirePHPHandler());
    }

}