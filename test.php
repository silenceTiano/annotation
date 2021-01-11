<?php

require_once __DIR__ . '/vendor/autoload.php';

/**
 * @Annotation
 */
class Value
{

    public $name;


}

/**
 * 通过php自带的类来获取类的相关内容，通过正则则可以获取到注释
 */
$c = new ReflectionClass(Value::class); //创建一个反射对象
$result = $c->getDocComment();    //获取注释内容
print_r($result);
