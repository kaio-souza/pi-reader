<?php
namespace Kaleu62\PIReader\Transformers;

use Kaleu62\PIReader\Entities\Config;

class ConfigTransformer{

    /**
     * @param array $array
     * @return Config
     */
    public static function transform(Array $array){
        $config = new Config();

        $config->setType($array['type'] ?? 'All');
        
        if(isset($array['apiKey']))
            $config->setApiKey($array['apiKey']);
            
        $config->setIsProduction($array['production'] ?? false);

        return $config;
    }
}