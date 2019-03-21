<?php
namespace Kaleu62\PIReader\Exceptions;

use Throwable;

class ApiKeyRequiredException extends \Exception
{
    /**
     * ApiKeyRequiredException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "To extract data from Images, is required the API Key from OCR SPACE (https://ocr.space/)", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
