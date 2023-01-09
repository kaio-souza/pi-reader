<?php

namespace Kaleu62\PIReader\Helpers;

use Kaleu62\PIReader\Constants\AccentsEquivalentsConstants;
use Kaleu62\PIReader\Constants\PossibleOCRInconsistenciesConstants;

class Helper
{
    /**
     * @param $text
     * @return string|string[]|null
     */
    public static function onlyNumeric($text)
    {
        return preg_replace("/[^0-9]/", "", $text);
    }

    /**
     * @param $text
     * @return string|string[]|null
     */
    public static function onlyAlphaNumericAndDots($text)
    {
        return preg_replace("/[^a-zA-Z0-9\.]/", "", $text);
    }

    /**
     * @param $text
     * @return mixed
     */
    public static function replaceChar($text, $a, $b)
    {
        return str_replace($a, $b, $text);
    }


    /**
     * @param $text
     * @return mixed
     */
    public static function removeAccents($text)
    {
        $a = AccentsEquivalentsConstants::originalLetters();
        $b = AccentsEquivalentsConstants::replaceLetters();
        return str_replace($a, $b, $text);
    }

    /**
     * @param $text
     * @param $regex
     * @return array
     */
    public static function extract($text, $regex)
    {
        $match = [];
        preg_match($regex, $text, $match);
        return $match;
    }

    public static function checkNecessaryTests($text)
    {

        $commomErrorCharacters = PossibleOCRInconsistenciesConstants::get();
        $possibleTests = [];

        foreach($commomErrorCharacters as $key => $value){
            if(stripos($text, $key)){
                $possibleTests[$key] = $value;
            }
        }

        return $possibleTests;
    }
}