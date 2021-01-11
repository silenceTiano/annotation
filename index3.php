<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\annotations\Value;
use App\core\ClassFactory;
use App\test\MyRedis;
use App\test\MyUsers;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;


//注册 注解的namespace
AnnotationRegistry::registerAutoloadNamespace("App\annotations");

//ClassFactory::getBean("xxx")
///
ClassFactory::ScanBeans(__DIR__ . "/app/test", "App\\test");
$myusers = ClassFactory::getBean(MyUsers::class);
var_dump($myusers);
///
//$myredis=ClassFactory::getBean("");


//$myredis=ClassFactory::loadClass(MyRedis::class);
//var_dump($myredis);



