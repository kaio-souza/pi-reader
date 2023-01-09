<?php

namespace Kaleu62\PIReader\Services;

use Kaleu62\PIReader\Helpers\Helper;

class MatchingSearchService
{
    private $textToMatch;
    private $originalRequestedText;
    private $actualRequestedText;

    /**
     * @param $parsedFile
     * @param $requestedText
     * @param bool $isImage
     * @return bool
     */
    public function existsText($parsedFile, $requestedText, $isImage = false)
    {
        $this->prepareTextData($parsedFile, $requestedText);

        if($this->checkMatching())
            return true;

        if($isImage){
            $imageTest = $this->makeImageParsedTests('checkMatching');
            if($imageTest)
                return $imageTest;
        }

        $sanitizedText = Helper::removeAccents($this->originalRequestedText);
        $this->actualRequestedText = $sanitizedText;

        if($this->checkMatching())
            return true;

    }

    /**
     * @param $parsedFile
     * @param $requestedText
     * @param bool $isImage
     * @return int
     */
    public function countText($parsedFile, $requestedText, $isImage = false)
    {
        $this->prepareTextData($parsedFile, $requestedText);

        $originalMatches = $this->countMatches();

        if($originalMatches)
            return $originalMatches;

        if($isImage){
            $imageTest = $this->makeImageParsedTests('countMatches');
            if($imageTest)
                return $imageTest;
        }

        $sanitizedText = Helper::removeAccents($this->originalRequestedText);
        $this->actualRequestedText = $sanitizedText;

        $sanitizedMatch = $this->countMatches;

        if($sanitizedMatch)
            return $sanitizedMatch;

    }

    /**
     * @param $parsedFile
     * @param $regex
     * @return array
     */
    public function regxText($parsedFile, $regex)
    {
        $this->prepareParsedTextWithoutSanitize($parsedFile);
        return Helper::extract($this->textToMatch, $regex);
    }

    /**
     * @param null $requestedText
     * @return bool
     */
    private function checkMatching(){
        if (stripos($this->textToMatch, Helper::onlyAlphaNumericAndDots($this->actualRequestedText)) !== false) {
            return true;
        }
    }

    /**
     * @param null $requestedText
     * @return int
     */
    private function countMatches(){

        $matches = substr_count($this->textToMatch, Helper::onlyAlphaNumericAndDots($this->actualRequestedText));
        if ($matches > 0) {
            return $matches;
        }
    }

    /**
     * @param $parsedFile
     * @param $requestedText
     */
    private function prepareTextData($parsedFile, $requestedText){
        $this->originalRequestedText = strtolower($requestedText);
        $this->actualRequestedText = $this->originalRequestedText;
        $this->prepareParsedText($parsedFile);

    }

    /**
     * @param $parsedFile
     */
    private function prepareParsedText($parsedFile){
        foreach ($parsedFile as $item)
        {
            $this->textToMatch .= strtolower(Helper::onlyAlphaNumericAndDots($item));
        }
    }

    /**
     * @param $parsedFile
     */
    private function prepareParsedTextWithoutSanitize($parsedFile){
        foreach ($parsedFile as $item)
        {
            $this->textToMatch .= $item;
        }
    }



    private function makeImageParsedTests($callback){

        $necessaryTests = Helper::checkNecessaryTests($this->originalRequestedText);

        foreach ($necessaryTests as $letter => $possibleLetters){
            foreach($possibleLetters as $possibleLetter)
            {
                $textAttempt = Helper::replaceChar($this->originalRequestedText, $letter, $possibleLetter);
                $this->actualRequestedText = $textAttempt;

                return $this->$callback();
            }
        }
    }
}