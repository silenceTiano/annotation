<?php
require_once __DIR__ . '/vendor/autoload.php';

use App\test\MyRider;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;


//比较旧的调用方式
//$r = new \App\test\MyRider();
//$r->conn_url = '123';

//新的，采用注解的方式进行调用

//注册 注解的namespace
AnnotationRegistry::registerAutoloadNamespace("App\annotations");

$rc=new ReflectionClass(MyRider::class);
$p=$rc->getProperty("conn_url");

$reader = new AnnotationReader();
$anno=$reader->getPropertyAnnotation($p,\App\annotations\Value::class);
echo $anno->name;

