<?php
namespace Kaleu62\PIReader\Services;

use Kaleu62\PIReader\Constants\TypeConstants;
use Kaleu62\PIReader\Entities\Config;
use Kaleu62\PIReader\Responses\FileResponse;

class FileReaderService{

    /**
     * @var array
     */
    private $config;

    /**
     * @var ParsePDFService
     */
    private $serviceParsePDF;

    /**
     * @var ParseIMGService
     */
    private $serviceParseIMG;


    function __construct(Config $config)
    {
        $this->serviceFileReader = new MatchingSearchService;
        $this->serviceParsePDF = new ParsePDFService;
        $this->serviceParseIMG = new ParseIMGService;
        $this->config = $config;

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
    private function requestPDFIMG($archivePath)
    {
        $data = $this->serviceParseIMG->getFileText($archivePath, $this->config->getApiKey(), $this->config->getIsProduction());
        if (count($data) > 0) return $data;
    }

    /**
     * @param $archivePath
     * @return array
     */
    public function getText($archivePath)
    {
        $file = [];
        $type = $this->config->getType();

        switch ($type)
        {
            case TypeConstants::PDF:
                $file = $this->requestPDFHTML($archivePath);
                break;
            case TypeConstants::IMG:
                $file = $this->requestPDFIMG($archivePath);
                break;
            default:
                $file = $this->requestPDFHTML($archivePath);

                if (count($file) == 0)
                {
                    $type = TypeConstants::IMG;
                    $file = $this->requestPDFIMG($archivePath);
                }else{
                    $type = TypeConstants::PDF;
                }
                break;
        }

        $response = new FileResponse();
        $response->setContent($file);
        $response->setType($type);

        return $response;
    }
}