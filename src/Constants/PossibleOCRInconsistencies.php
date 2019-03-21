<?php
namespace Kaleu62\PIReader\Constants;

class PossibleOCRInconsistencies{
    public static function get(){
        return [
            'ç' => ['q', 'g'],
            'o' => ['0'],
            'i' => ['1'],
            't' => ['7'],
            'a' => ['4'],
            'q' => ['o']
        ];
    }
}