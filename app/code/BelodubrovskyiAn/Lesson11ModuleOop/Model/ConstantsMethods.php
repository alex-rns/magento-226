<?php
namespace BelodubrovskyiAn\Lesson11ModuleOop\Model;

class ConstantsMethods
{
    const NONE = 0;
    const REQUEST = 100;
    const AUTH = 101;
    const QWE = 'qwe';
    /**
     * @return int
     */
    public function firstMethod()
    {
        return 5;
    }
    /**
     * @return string
     */
    final function secondMethod()
    {
        return 'second';
    }
    /**
     * @return bool
     */
    private static function thirdMethod()
    {
        return true;
    }

    /**
     * @return array
     * @throws \ReflectionException
     */
    public function getConstants()
    {
        $oClass = new \ReflectionClass(__CLASS__);
        return $oClass->getConstants();
    }

    /**
     * @return \ReflectionMethod[]
     * @throws \ReflectionException
     */
    public function getMethods()
    {
        $class = new \ReflectionClass(__CLASS__);
        return $class->getMethods();
    }
}

