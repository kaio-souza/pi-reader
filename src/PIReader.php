<?php

namespace Kaleu62\PIReader;

use Kaleu62\PIReader\Constants\TypeConstant;
use Kaleu62\PIReader\Services\ServiceFileReader;
use Kaleu62\PIReader\Services\ServiceParsePDF;
use Kaleu62\PIReader\Services\ServiceParseIMG;

class PIReader
{
    /**
     * @var ServiceParsePDF
     */
    private $serviceParsePDF;

    /**
     * @var ServiceParseIMG
     */
    private $serviceParseIMG;

    /*
     *   @var ServiceFileReader
     */
    private $serviceFileReader;

    /**
     * @var array
     */
    private $config;

    private $isImage;
    /**
     * @var array
     */
    private $types;


    function __construct(array $config)
    {
        $this->serviceFileReader = new ServiceFileReader;
        $this->serviceParsePDF = new ServiceParsePDF;
        $this->serviceParseIMG = new ServiceParseIMG;
        $this->config = $config;
        $this->types = [TypeConstant::PDF, TypeConstant::IMG];

        if (!isset($config['apiKey']) && $config['type'] != TypeConstant::PDF) throw new \Exception("Para extrair dados de imagem, é necessario assinar o OCR: https://ocr.space/ ");

        if (!isset($config['production'])) $this->config['production'] = false;
        if (!isset($config['type'])) $this->config['type'] = 'All';
    }

    /**
     * @param $archivePath
     * @return array
     * @throws \Exception
     */
    private function requestPDFHTML($archivePath)
    {
        $data = $this->serviceParsePDF->getFileText($archivePath);
        if (count($data) > 0) return $data;
    }

    /**
     * @param $archivePath
     * @param $apiKey
     * @param $env
     * @return array
     */
    private function requestPDFIMG($archivePath, $apiKey, $env)
    {
        $data = $this->serviceParseIMG->getFileText($archivePath, $apiKey, $env);
        if (count($data) > 0) return $data;
    }

    /**
     * @param $archivePath
     * @return array
     */
    public function getArchive($archivePath)
    {
        $archieve = [];
        switch ($this->config['type'])
        {
            case TypeConstant::PDF:
                $this->isImage = false;
                $archieve = $this->requestPDFHTML($archivePath);
                break;
            case TypeConstant::IMG:
                $this->isImage = true;
                $archieve = $this->requestPDFIMG($archivePath, $this->config['apiKey'], $this->config['production']);
                break;
            default:
                $archieve = $this->requestPDFHTML($archivePath);
                $this->isImage = false;
                if (count($archieve) == 0)
                {
                    $this->isImage = true;
                    $archieve = $this->requestPDFIMG($archivePath, $this->config['apiKey'], $this->config['production']);
                }
                break;

        }
        return $archieve;
    }

    /**
     * @param $archivePath
     * @param $requestedText
     * @return bool
     */
    public function existsInFile($archivePath, $requestedText)
    {
        $file = $this->getArchive($archivePath);
        return $this->serviceFileReader->existsText($file, $requestedText, $this->isImage);
    }

    /**
     * @param $archivePath
     * @param $requestedText
     * @return int
     */
    public function countOccurrences($archivePath, $requestedText)
    {
        $file = $this->getArchive($archivePath);
        return $this->serviceFileReader->countText($file, $requestedText, $this->isImage);
    }

    public function regexFind($archivePath, $regex)
    {
        $file = $this->getArchive($archivePath);
        return $this->serviceFileReader->regxText($file, $regex);
    }

}
