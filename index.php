<?php
require_once __DIR__ . '/vendor/autoload.php';

use App\test\MyRedis;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;


//比较旧的调用方式
//$r = new \App\test\MyRedis();
//$r->conn_url = '123';

//新的，采用注解的方式进行调用

//注册 注解的namespace
AnnotationRegistry::registerAutoloadNamespace("App\annotations");

$rc = new ReflectionClass(MyRedis::class);
$p = $rc->getProperty("conn_url");

$reader = new AnnotationReader();
/**
 * 此处方法读取属性的注解也可以获取类或者方法的注解
 * $reader->getClassAnnotation();
 * $reader->getMethodAnnotation();
 */
$anno = $reader->getPropertyAnnotation($p, \App\annotations\Value::class);
echo $anno->name;

