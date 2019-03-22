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
    private $parsePDFService;

    /**
     * @var ParseIMGService
     */
    private $parseIMGService;

    /**
     * @var MatchingSearchService
     */
    private $fileReaderService;

    function __construct(Config $config)
    {
        $this->fileReaderService = new MatchingSearchService;
        $this->parsePDFService = new ParsePDFService;
        $this->parseIMGService = new ParseIMGService;
        $this->config = $config;

    }

    /**
     * @param $archivePath
     * @return array
     * @throws \Exception
     */
    private function requestPDFHTML($archivePath)
    {
        $data = $this->parsePDFService->getFileText($archivePath);
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
        $data = $this->parseIMGService->getFileText($archivePath, $this->config->getApiKey(), $this->config->getIsProduction());
        if (count($data) > 0) return $data;
    }

    /**
     * @param $archivePath
     * @return FileResponse
     * @throws \Exception
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
                $totalFiles = count($file);

                $type = $totalFiles == 0 ? TypeConstants::IMG : TypeConstants::PDF;

                if ($totalFiles == 0)
                    $file = $this->requestPDFIMG($archivePath);

                break;
        }

        $response = new FileResponse();
        $response->setContent($file);
        $response->setType($type);

        return $response;
    }
}