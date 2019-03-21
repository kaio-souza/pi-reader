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
        $config->setApiKey($array['apiKey'] ?? null);
        $config->setIsProduction($array['production'] ?? false);

        return $config;
    }
}