<?php

namespace Kaleu62\PIReader\Traits;


/**
 * Trait ConstantsTrait
 * @package Kaleu62\PIReader\Traits
 */
trait ConstantsTrait
{
    /** @var array */
    private static $constCache = [];

    /**
     * @return array
     * @throws \ReflectionException
     */
    static function getConstants() {
        $oClass = new \ReflectionClass(__CLASS__);
        return $oClass->getConstants();
    }

    static function getConstantsKeys() {
        $constants = self::getConstants();
        $result = [];

        foreach ($constants as $key => $value) {
            $result[] = $key;
        }

        return $result;
    }

    static function getConstantsValues() {
        $constants = self::getConstants();
        $result = [];
        
        foreach ($constants as $key => $value) {
            $result[] = $value;
        }

        return $result;
    }

}
