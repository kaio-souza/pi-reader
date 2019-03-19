<?php

namespace Kaleu62\PIReader\Helpers;

class Helper
{

    public static function onlyNumeric($text)
    {
        return preg_replace("/[^0-9\.]/", "", $text);
    }
    public static function onlyAlphaNumeric($text)
    {
        return preg_replace("/[^a-zA-Z0-9\.]/", "", $text);
    }

    public function commomOcrErrorO($text){
        $a = array('o');
        $b = array('0');
        return str_replace($a, $b, $text);
    }

    public function commomOcrErrorI($text){
        $a = array('i');
        $b = array('1');
        return str_replace($a, $b, $text);
    }

    public function commomOcrErrorC($text){
        $a = array('ç');
        $b = array('q');
        return str_replace($a, $b, $text);
    }

    public function commomOcrErrorT($text){
        $a = array('t');
        $b = array('7');
        return str_replace($a, $b, $text);
    }

    public function commomOcrErrorA($text){
        $a = array('a');
        $b = array('4');
        return str_replace($a, $b, $text);
    }

    public function allCommomOcrErrors($text){
        $a = array('o', 'i', 'ç', 't');
        $b = array('0', '1', 'q', '7');
        return str_replace($a, $b, $text);
    }

    public function removeAccents($text)
    {
        $a = array('à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ð', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'ā', 'ā', 'ă', 'ă', 'ą', 'ą', 'ć', 'ć', 'ĉ', 'ĉ', 'ċ', 'ċ', 'č', 'č', 'ď', 'ď', 'đ', 'đ', 'ē', 'ē', 'ĕ', 'ĕ', 'ė', 'ė', 'ę', 'ę', 'ě', 'ě', 'ĝ', 'ĝ', 'ğ', 'ğ', 'ġ', 'ġ', 'ģ', 'ģ', 'ĥ', 'ĥ', 'ħ', 'ħ', 'ĩ', 'ĩ', 'ī', 'ī', 'ĭ', 'ĭ', 'į', 'į', 'i̇', 'ı', 'ĳ', 'ĳ', 'ĵ', 'ĵ', 'ķ', 'ķ', 'ĺ', 'ĺ', 'ļ', 'ļ', 'ľ', 'ľ', 'ŀ', 'ŀ', 'ł', 'ł', 'ń', 'ń', 'ņ', 'ņ', 'ň', 'ň', 'ŉ', 'ō', 'ō', 'ŏ', 'ŏ', 'ő', 'ő', 'œ', 'œ', 'ŕ', 'ŕ', 'ŗ', 'ŗ', 'ř', 'ř', 'ś', 'ś', 'ŝ', 'ŝ', 'ş', 'ş', 'š', 'š', 'ţ', 'ţ', 'ť', 'ť', 'ŧ', 'ŧ', 'ũ', 'ũ', 'ū', 'ū', 'ŭ', 'ŭ', 'ů', 'ů', 'ű', 'ű', 'ų', 'ų', 'ŵ', 'ŵ', 'ŷ', 'ŷ', 'ÿ', 'ź', 'ź', 'ż', 'ż', 'ž', 'ž', 'ſ', 'ƒ', 'ơ', 'ơ', 'ư', 'ư', 'ǎ', 'ǎ', 'ǐ', 'ǐ', 'ǒ', 'ǒ', 'ǔ', 'ǔ', 'ǖ', 'ǖ', 'ǘ', 'ǘ', 'ǚ', 'ǚ', 'ǜ', 'ǜ', 'ǻ', 'ǻ', 'ǽ', 'ǽ', 'ǿ', 'ǿ');
        $b = array('a', 'a', 'a', 'a', 'a', 'a', 'ae', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'd', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'a', 'a', 'a', 'a', 'a', 'a', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'd', 'd', 'd', 'd', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'g', 'g', 'g', 'g', 'g', 'g', 'g', 'g', 'h', 'h', 'h', 'h', 'i', 'i', 'i', 'i', 'i', 'i', 'i', 'i', 'i', 'i', 'ij', 'ij', 'j', 'j', 'k', 'k', 'l', 'l', 'l', 'l', 'l', 'l', 'l', 'l', 'l', 'l', 'n', 'n', 'n', 'n', 'n', 'n', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'oe', 'oe', 'r', 'r', 'r', 'r', 'r', 'r', 's', 's', 's', 's', 's', 's', 's', 's', 't', 't', 't', 't', 't', 't', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'w', 'w', 'y', 'y', 'y', 'z', 'z', 'z', 'z', 'z', 'z', 's', 'f', 'o', 'o', 'u', 'u', 'a', 'a', 'i', 'i', 'o', 'o', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'a', 'a', 'ae', 'ae', 'o', 'o');
        return str_replace($a, $b, $text);
    }

   public static function extract($text, $regex)
    {
        $match = [];
        preg_match($regex, $text, $match);
       return $match;
   }


}