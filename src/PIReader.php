<?php

namespace Kaleu62\PIReader;

use Kaleu62\PIReader\Constants\TypeConstants;
use Kaleu62\PIReader\Helpers\ConfigHelper;
use Kaleu62\PIReader\Responses\FileResponse;
use Kaleu62\PIReader\Services\FileReaderService;
use Kaleu62\PIReader\Services\MatchingSearchService;

class PIReader
{

    /*
     *   @var MatchingSearchService
     */
    private $matchingSearchService;

    /*
     *   @var MatchingSearchService
     */
    private $fileReaderService;

    /**
     *   @var bool
     */
    private $isImage;



    /**
     * PIReader constructor.
     * @param array $config
     * @throws \Exception
     */
    function __construct(array $input)
    {
        // Verify and Set configs
        $config = ConfigHelper::verify($input);

        // Instantiate Services
        $this->matchingSearchService = new MatchingSearchService;
        $this->fileReaderService = new FileReaderService($config);
    }

    /**
     * @param $archivePath
     * @return array
     */
    public function getArchive($archivePath)
    {
        // Try Get File Parsed
        $fileResponse = $this->fileReaderService->getText($archivePath);

        if ($fileResponse instanceof FileResponse)
        {
            // Return Parsed File and set Type
            $this->isImage = $fileResponse->type == TypeConstants::IMG;
            return $fileResponse->content;
        }

        return null;
    }

    /**
     * @param $archivePath
     * @param $requestedText
     * @return bool
     */
    public function existsInFile($archivePath, $requestedText)
    {
        // Get File Content
        $file = $this->getArchive($archivePath);

        // Check Correspondence
        return $this->matchingSearchService->existsText($file, $requestedText, $this->isImage);
    }

    /**
     * @param $archivePath
     * @param $requestedText
     * @return int
     */
    public function countOccurrences($archivePath, $requestedText)
    {
        // Get File Content
        $file = $this->getArchive($archivePath);
        // Check Count Correspondence
        return $this->matchingSearchService->countText($file, $requestedText, $this->isImage);
    }

    /**
     * @param $archivePath
     * @param $regex
     * @return array
     */
    public function regexFind($archivePath, $regex)
    {
        // Get File Content
        $file = $this->getArchive($archivePath);

        // Find match to regular expression
        return $this->matchingSearchService->regxText($file, $regex);
    }

}
