<?php

namespace Kaleu62\PIReader\Services;

use Kaleu62\PIReader\Clients\ClientOCR;

class ServiceParseIMG
{
    /**
     * @var array
     */
    private $matchesPerPage = [];

    final public function loadDataImage($archiveUrl, $apiKey, $env)
    {

        try
        {
            $client = new ClientOCR($archiveUrl, $apiKey, $env);
            $results = $client->readImg();

            if (!empty($results))
            {
                foreach ($results->ParsedResults as $result)
                {
                    $result = (object)$result;
                    $this->matchesPerPage[] = $result->ParsedText;
                }
            }
            return $this->matchesPerPage;
        }
        catch (Exception $e)
        {
            return $this->matchesPerPage;
        }
    }

    final public function getFileText($archivePath, $apiKey, $env)
    {
        return $this->loadDataImage($archivePath, $apiKey, $env);
    }
}