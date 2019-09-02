<?php

namespace Kaleu62\PIReader\Clients;

use Exception;
use GuzzleHttp\Client;


class ClientOCR extends Client
{

    /**
     * @var string
     * URL of free OCR server
     */
    const BASE_URI_FREE = 'https://api.ocr.space/parse/image';

    /**
     * @var int
     * Max time, in seconds, to wait for the server - if server take longer will use next server on next request
     */
    const MAX_TIME_SERVER = 30;

    /**
     * @var array
     * List of OCR servers. Key must be sequential
     */
    private $servers = [
        1 => 'https://apipro1.ocr.space/parse/image',
        2 => 'https://apipro2.ocr.space/parse/image',
        3 => 'https://apipro3.ocr.space/parse/image'
    ];

    /**
     * @var string
     */
    private $pid = "last.pid";

    /**
     * @var string
     */
    private $server;

    /**
     * @var string
     */
    private $archiveUrl;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var string
     */
    private $baseUri;

    /**
     * ClientOCR constructor.
     * @param $archiveUrl
     */
    function __construct($archiveUrl, $apiKey, $env, $config = null)
    {
        parent::__construct();
        if (isset($config['tempFolder']))
            $this->pid = $config['tempFolder'] . '/' . $this->pid;

        $this->server = $this->chooseServer();
        $this->archiveUrl = $archiveUrl;
        $this->apiKey = $apiKey;
        $this->baseUri = $env == true ? $this->servers[$this->server] : self::BASE_URI_FREE;
    }

    public function chooseServer()
    {
        $server = 1;
        if (file_exists($this->pid)) {
            $stats = file($this->pid);
            list($serverNumber, $serverTime) = explode(";", $stats[0]);
            $serverFromFile = $serverTime > self::MAX_TIME_SERVER ? $serverNumber : ($serverNumber + 1);
            $server = $serverFromFile <= count($this->servers) ? $serverFromFile : 1;
        }
        return $server;
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function readImg()
    {
        $after = time();
        $request = $this->post($this->baseUri, [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'apikey' => $this->apiKey
            ],
            'form_params' => [
                'url' => $this->archiveUrl,
                'language' => 'por',
                'detectOrientation' => 'True',
                'scale' => 'True',
                'isOverlayRequired' => 'False',
            ]
        ]);
        $body = json_decode($request->getBody());

        if (isset($body->ErrorMessage))
            throw new Exception($body->ErrorMessage[0]);

        $before = time();
        $timeProcess = $before - $after;
        $this->savePid($timeProcess);
        return $body;
    }

    public function savePid($timeProcess)
    {
        $text = $this->server . ";" . $timeProcess;
        $file = @fopen($this->pid, 'w');
        @fwrite($file, $text);
        @fclose($file);
    }
}
