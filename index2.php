<?php
/**
 * 通过反射类的方式调用
 */

require_once __DIR__ . '/vendor/autoload.php';

use App\core\ClassFactory;
use App\test\MyRedis;
use Doctrine\Common\Annotations\AnnotationRegistry;

AnnotationRegistry::registerAutoloadNamespace("App\annotations");
$redis = ClassFactory::loadClass(MyRedis::class);
var_dump($redis);
