<?php

namespace Kaleu62\PIReader\Services;

use Kaleu62\PIReader\Helpers\Helper;

class ServiceFileReader
{
    private $text;

    /**
     * @param $parsedFile
     * @param $requestedText
     * @param bool $isImage
     * @return bool
     */
    public function existsText($parsedFile, $requestedText, $isImage = false)
    {
        $requestedText = strtolower($requestedText);

        $this->prepareParsedText($parsedFile);

        if($this->checkMatching($requestedText)){
            return true;
        };

        if($isImage){

            $necessaryTests = Helper::checkNecessaryTests($requestedText);

            foreach ($necessaryTests as $letter => $possibleLetters){
                foreach($possibleLetters as $possibleLetter){
                    $textAttempt = Helper::commomOcrError($requestedText, $letter, $possibleLetter);
                    if($this->checkMatching($textAttempt)){
                        return true;
                    };
                }
            }

        }

        $sanitizedText = Helper::removeAccents($requestedText);

        if($this->checkMatching($sanitizedText)){
            return true;
        };
    }

    /**
     * @param $parsedFile
     * @param $regex
     * @return array
     */
    public function regxText($parsedFile, $regex)
    {
        $this->prepareParsedTextWithoutSanitize($parsedFile);

        return Helper::extract($this->text, $regex);
    }

    /**
     * @param $parsedFile
     * @param $requestedText
     * @param bool $isImage
     * @return int
     */
    public function countText($parsedFile, $requestedText, $isImage = false)
    {
        $requestedText = strtolower($requestedText);

        $this->prepareParsedText($parsedFile);

        $originalMatches = $this->countMatches($requestedText);

        if($originalMatches > 0){
            return $originalMatches;
        };

        if($isImage){

            $necessaryTests = Helper::checkNecessaryTests($requestedText);

            foreach ($necessaryTests as $letter => $possibleLetters){
                foreach($possibleLetters as $possibleLetter)
                {
                    $textAttempt = Helper::commomOcrError($requestedText, $letter, $possibleLetter);
                    $testMatch = $this->countMatches($textAttempt);
                    if ($testMatch > 0)
                    {
                        return $testMatch;
                    };
                }
            }

        }
        $sanitizedText = Helper::removeAccents($requestedText);
        $sanitizedMatch = $this->countMatches($sanitizedText);
        if($sanitizedMatch > 0){
            return $sanitizedMatch;
        };
    }

    /**
     * @param $parsedFile
     */
    public function prepareParsedTextWithoutSanitize($parsedFile){
        foreach ($parsedFile as $item)
        {
            $this->text .= $item;
        }
    }

    /**
     * @param $parsedFile
     */
    public function prepareParsedText($parsedFile){
        foreach ($parsedFile as $item)
        {
            $this->text .= strtolower(Helper::onlyAlphaNumeric($item));
        }
    }

    /**
     * @param $text
     * @return bool
     */
    public function checkMatching($text){

        if (strpos($this->text, Helper::onlyAlphaNumeric($text)) !== false) {
            return true;
        }
    }

    /**
     * @param $text
     * @return int
     */
    public function countMatches($text){
        $matches = substr_count($this->text, Helper::onlyAlphaNumeric($text));
        if ($matches > 0) {
            return $matches;
        }
    }



}