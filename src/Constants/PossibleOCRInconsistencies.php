<?php
namespace Kaleu62\PIReader\Constants;

/**
 * Class PossibleOCRInconsistencies
 * @package Kaleu62\PIReader\Constants
 */
class PossibleOCRInconsistencies{
    const LETTER_C_CEDILLA = ['q', 'g'];
    const LETTER_O = ['0'];
    const LETTER_I = ['1'];
    const LETTER_T = ['7'];
    const LETTER_A = ['4'];
    const LETTER_Q = ['o'];

    /**
     * @return array
     */
    public static function get(){
        return [
            'ç' => self::LETTER_C_CEDILLA,
            'o' => self::LETTER_O,
            'i' => self::LETTER_I,
            't' => self::LETTER_T,
            'a' => self::LETTER_A,
            'q' => self::LETTER_Q
        ];
    }
}