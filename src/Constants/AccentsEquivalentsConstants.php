<?php

namespace Kaleu62\PIReader\Constants;

use Kaleu62\PIReader\Traits\ConstantsTrait;

/**
 * Class AccentsEquivalentsConstants
 * @package Kaleu62\PIReader\Constants
 */
class AccentsEquivalentsConstants
{
    use ConstantsTrait;

    const ACCENTS_REPLACE= ['ß' => 'b', 'ð' => 'o', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c', 'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ý' => 'y', 'ÿ' => 'y', 'ā' => 'a', 'ă' => 'a', 'ă' => 'aa', 'ą' => 'a', 'ć' => 'a', 'ć' => 'c', 'ĉ' => 'c', 'ċ' => 'c', 'č' => 'c', 'ď' => 'd', 'đ' => 'd', 'ē' => 'e', 'ĕ' => 'e', 'ė' => 'e', 'ę' => 'e', 'ě' => 'e', 'ĝ' => 'g', 'ğ' => 'g', 'ġ' => 'g', 'ģ' => 'g', 'ĥ' => 'h', 'ħ' => 'h', 'ĩ' => 'i', 'ī' => 'i', 'ĭ' => 'i', 'į' => 'i', 'i̇' => 'i', 'ı' => 'i', 'ĳ' => 'ij', 'ĵ' => 'j', 'ķ' => 'k', 'ĺ' => 'l', 'ļ' => 'l', 'ľ' => 'l', 'ŀ' => 'l', 'ł' => 'l', 'ń' => 'n', 'ņ' => 'n', 'ň' => 'n', 'ŉ' => 'n', 'ō' => 'o', 'ŏ' => 'o', 'ő' => 'o', 'œ' => 'oe', 'ŕ' => 'r', 'ŗ' => 'r', 'ř' => 'r', 'ś' => 'r', 'ś' => 's', 'ŝ' => 's', 'ş' => 's', 'š' => 's', 'ţ' => 't', 'ť' => 't', 'ŧ' => 't', 'ũ' => 'u', 'ū' => 'u', 'ŭ' => 'u', 'ů' => 'u', 'ű' => 'u', 'ų' => 'u', 'ŵ' => 'w', 'ŷ' => 'y', 'ź' => 'z', 'ż' => 'z', 'ž' => 'z', 'ſ' => 'f', 'ƒ' => 'f', 'ơ' => 'o', 'ư' => 'u', 'ǎ' => 'a', 'ǐ' => 'a', 'ǐ' => 'i', 'ǒ' => 'o', 'ǔ' => 'u', 'ǖ' => 'u', 'ǘ' => 'u', 'ǚ' => 'u', 'ǜ' => 'u', 'ǻ' => 'a', 'ǽ' => 'ae', 'ǿ' => 'o'];

    /**
     * @return array
     */
    public static function originalLetters(){
        return array_keys(self::ACCENTS_REPLACE);
    }

    /**
     * @return array
     */
    public static function replaceLetters(){
        return array_values(self::ACCENTS_REPLACE);
    }
}