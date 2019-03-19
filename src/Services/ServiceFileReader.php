<?php

namespace Kaleu62\PIReader\Services;

use Kaleu62\PIReader\Helpers\Helper;

class ServiceFileReader
{
    private $text;

    public function existsText($parsedFile, $requestedText, $isImage = false)
    {
        $requestedText = strtolower($requestedText);

        $this->prepareParsedText($parsedFile);

        if($this->checkMatching($requestedText)){
            return true;
        };

        if($isImage){
            if(strpos($requestedText, 'ç')){
                $textAttempt = Helper::commomOcrErrorC($requestedText);
                if($this->checkMatching($textAttempt)){
                    return true;
                };
            }

            if(strpos($requestedText, 'o')){
                $textAttempt = Helper::commomOcrErrorO($requestedText);
                if($this->checkMatching($textAttempt)){
                    return true;
                };
            }
            if(strpos($requestedText, 'i')){
                $textAttempt = Helper::commomOcrErrorI($requestedText);
                if($this->checkMatching($textAttempt)){
                    return true;
                };
            }
            if(strpos($requestedText, 't')){
                $textAttempt = Helper::commomOcrErrorT($requestedText);
                if($this->checkMatching($textAttempt)){
                    return true;
                };
            }

            if(strpos($requestedText, 'a')){
                $textAttempt = Helper::commomOcrErrorA($requestedText);
                if($this->checkMatching($textAttempt)){
                    return true;
                };
            }

        }
        $sanitizedText = Helper::removeAccents($requestedText);
        if($this->checkMatching($sanitizedText)){
            return true;
        };
    }

    public function regxText($parsedFile, $regex)
    {
        $this->prepareParsedTextWithoutSanitize($parsedFile);

        return Helper::extract($this->text, $regex);
    }

    public function countText($parsedFile, $requestedText, $isImage = false)
    {
        $requestedText = strtolower($requestedText);

        $this->prepareParsedText($parsedFile);

        $originalMatches = $this->countMatches($requestedText);

        if($originalMatches > 0){
            return $originalMatches;
        };

        if($isImage){
            if(strpos($requestedText, 'ç')){
                $textAttempt = Helper::commomOcrErrorC($requestedText);
                $testMatch = $this->countMatches($textAttempt);
                if($testMatch > 0){
                    return $testMatch;
                };
            }

            if(strpos($requestedText, 'o')){
                $textAttempt = Helper::commomOcrErrorO($requestedText);
                $testMatch = $this->countMatches($textAttempt);
                if($testMatch > 0){
                    return $testMatch;
                };
            }
            if(strpos($requestedText, 'i')){
                $textAttempt = Helper::commomOcrErrorI($requestedText);
                $testMatch = $this->countMatches($textAttempt);
                if($testMatch > 0){
                    return $testMatch;
                };
            }
            if(strpos($requestedText, 't')){
                $textAttempt = Helper::commomOcrErrorT($requestedText);
                $testMatch = $this->countMatches($textAttempt);
                if($testMatch > 0){
                    return $testMatch;
                };
            }

            if(strpos($requestedText, 'a')){
                $textAttempt = Helper::commomOcrErrorA($requestedText);
                $testMatch = $this->countMatches($textAttempt);
                if($testMatch > 0){
                    return $testMatch;
                };
            }
        }
        $sanitizedText = Helper::removeAccents($requestedText);
        $sanitizedMatch = $this->countMatches($sanitizedText);
        if($sanitizedMatch > 0){
            return $sanitizedMatch;
        };
    }


    public function prepareParsedTextWithoutSanitize($parsedFile){
        foreach ($parsedFile as $item)
        {
            $this->text .= $item;
        }
    }

    public function prepareParsedText($parsedFile){
        foreach ($parsedFile as $item)
        {
            $this->text .= strtolower(Helper::onlyAlphaNumeric($item));
        }
    }

    public function checkMatching($text){
        if (strpos($this->text, Helper::onlyAlphaNumeric($text)) !== false) {
            return true;
        }
    }

    public function countMatches($text){
        $matches = substr_count($this->text, Helper::onlyAlphaNumeric($text));
        if ($matches > 0) {
            return $matches;
        }
    }

}