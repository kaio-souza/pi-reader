<?php

namespace Kaleu62\PIReader\Entities;

/**
 * Class Config
 * @package Kaleu62\PIReader\Entities
 */
class Config{
    /**
     * @string API Key from https://ocr.space/
     */
    private $apiKey;

    /**
     * @bool control use of apiKey
     */
    private $isProduction;

    /**
     * @string File Type From  @Kaleu62\PIReader\Constants\TypeConstants
     */
    private $type;

    /**
     * @return mixed
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @param mixed $apiKey
     * @return Config
     */
    public function setApiKey(string $apiKey)
    {
        $this->apiKey = $apiKey;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsProduction()
    {
        return $this->isProduction;
    }

    /**
     * @param mixed $isProduction
     * @return Config
     */
    public function setIsProduction(bool $isProduction)
    {
        $this->isProduction = $isProduction;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     * @return Config
     */
    public function setType(string $type)
    {
        $this->type = $type;
        return $this;
    }

}