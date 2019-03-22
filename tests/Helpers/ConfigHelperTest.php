<?php

namespace Kaleu62\PIReader\Helpers;



use Kaleu62\PIReader\Constants\TypeConstants;
use Kaleu62\PIReader\Entities\Config;
use Kaleu62\PIReader\Exceptions\ApiKeyRequiredException;
use Kaleu62\PIReader\Exceptions\InvalidConfigException;
use PHPUnit\Framework\TestCase;


class ConfigHelperTest extends TestCase
{
    public function test_valid_config_only_api_key(){
        $data = [
            'apiKey' => 'xxx'
        ];
        $test = ConfigHelper::verify($data);
        $this->assertInstanceOf(Config::class, $test);
    }

    public function test_config_missing_type_and_key(){
        $this->expectException(ApiKeyRequiredException::class);
        $data = [
            'production' => true
        ];
        
        ConfigHelper::verify($data);
    }

    public function test_config_invalid_type(){
        $this->expectException(InvalidConfigException::class);
        $data = [
            'type' => 'te'
        ];
        
        ConfigHelper::verify($data);
    }

    public function test_config_only_valid_type(){

        $data = [
            'type' => TypeConstants::PDF
        ];
        
        $test = ConfigHelper::verify($data);
        $this->assertInstanceOf(Config::class, $test);
    }

}
