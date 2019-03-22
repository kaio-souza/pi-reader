<?php

namespace Kaleu62\PIReader\Helpers;

use Kaleu62\PIReader\Helpers\Helper as HelperPIReader;

use PHPUnit\Framework\TestCase;


class HelperTest extends TestCase
{
    public function test_only_numeric(){
        $string = "asd123.;[]p&*+/*-,%\"'£¢¬¹³²!?";
        $result = "123";
        $test = HelperPIReader::onlyNumeric($string);
        $this->assertEquals($result, $test);
    }
    public function test_only_alpha_numeric_and_dots(){
        $string = "asd123.;[]{}ºª^~&*+/*-,%\"'£¢¬¹³²!?";
        $result = "asd123.";
        $test = HelperPIReader::onlyAlphaNumericAndDots($string);
        $this->assertEquals($result , $test);
    }

    public function test_replace_char(){
        $string = "John Doe";
        $char1 = "D";
        $char2 = "J";
        $result = "John Joe";
        $test = HelperPIReader::replaceChar($string, $char1, $char2);
        $this->assertEquals($result, $test);
    }


    public function test_extract(){
        $string = "John Doe 12.12 1";
        $regex = "[\d{2}\.\d{2} \d{1}]";
        $result = '12.12 1';
        $test = HelperPIReader::extract($string,$regex);
        $this->assertEquals($result, $test[0]);
    }

    public function test_remove_accents(){
        $string = "àáâãäåæèéêëìíîïðñòóôõöøùúûüýßàáâãäåæçèéêëìíîïñòóôõöøùúûüýÿāāăăććĉĉċċččďďđđēēĕĕėėęęěěĝĝğğġġģģĥĥħħĩĩīīĭĭįįi̇ıĳĳĵĵķķĺĺļļľľŀŀłłńńņņňňŉōōŏŏőőœœŕŕŗŗřřśśŝŝşşššţţťťŧŧũũūūŭŭůůűűųųŵŵŷŷÿźźżżžžſƒơơưưǎǎǐǐǒǒǔǔǖǖǘǘǚǚǜǜǻǻǽǽǿǿ";
        $result = "aaaaaaaeeeeeiiiionoooooouuuuybaaaaaaaeceeeeiiiinoooooouuuuyyaaaaaaccccccccddddeeeeeeeeeegggggggghhhhiiiiiiiiiiijijjjkkllllllllllnnnnnnnoooooooeoerrrrrrssssssssttttttuuuuuuuuuuuuwwyyyzzzzzzffoouuaaiioouuuuuuuuuuaaaeaeoo";

        $test = HelperPIReader::removeAccents($string);
        $this->assertEquals($result , $test);
    }
}
