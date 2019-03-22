<?php

namespace Kaleu62\PIReader\Helpers;

use Kaleu62\PIReader\Constants\TypeConstants;
use Kaleu62\PIReader\Exceptions\ApiKeyRequiredException;
use Kaleu62\PIReader\Exceptions\InvalidConfigException;
use Kaleu62\PIReader\Exceptions\ConfigParamsException;
use Kaleu62\PIReader\Transformers\ConfigTransformer;

class ConfigHelper{

    /**
     * @param array|null $config
     * @return \Kaleu62\PIReader\Entities\Config
     * @throws ApiKeyRequiredException
     */
    public static function verify(array $config = null){

        if(isset($config['type']) && !in_array($config['type'], TypeConstants::getConstantsValues())){
            throw new InvalidConfigException("Invalid Type");
            exit;
        }
        
        if (!isset($config['apiKey']) && ( !isset($config['type']) || $config['type'] != TypeConstants::PDF ) ){
            throw new ApiKeyRequiredException();
            exit;
        }

        return ConfigTransformer::transform($config);
    }

}