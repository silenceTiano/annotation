<?php

namespace App\core;

use App\annotations\Bean;
use Doctrine\Common\Annotations\AnnotationReader;

class ClassFactory
{

    private static $beans = [];//key-value

    public static function ScanBeans(string $path, string $namespace)
    {
        $phpfiles = glob($path . "/*.php");
        foreach ($phpfiles as $php) {
            require($php);
        }
        $reader = new  AnnotationReader();
        $classes = get_declared_classes();
        foreach ($classes as $class) {
            if (strstr($class, $namespace)) {
                $ref_class = new \ReflectionClass($class);
                $annos = $reader->getClassAnnotations($ref_class);
                foreach ($annos as $anno) {
                    if ($anno instanceof Bean) {
                        self::$beans[$ref_class->getName()] = self::loadClass($ref_class->getName(), $ref_class->newInstance());
                    }
                }
            }
        }
    }

    public static function getBean(string $beanName)
    {
        if (isset(self::$beans[$beanName]))
            return self::$beans[$beanName];
        return false;
    }

    public static function loadClass($classname, $object = false)
    {

        $ref_class = new \ReflectionClass($classname);
        $properties = $ref_class->getProperties();

        $reader = new  AnnotationReader();
        ///////////下面是处理 属性注解
        foreach ($properties as $property) {
            $annos = $reader->getPropertyAnnotations($property);
            foreach ($annos as $anno) {
                $getValue = $anno->do(); // 假设do 返回我们的业务数据
                $retObj = $object ? $object : $ref_class->newInstance();
                $property->setValue($retObj, $getValue);
                return $retObj;
            }
        }
        return $object ? $object : $ref_class->newInstance();

    }
}
