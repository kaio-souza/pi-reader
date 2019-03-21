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
     */
    static function getConstants() {
        $oClass = new \ReflectionClass(__CLASS__);
        return $oClass->getConstants();
    }

}
