<?php
namespace Kaleu62\PIReader\Exceptions;

use Throwable;

class InvalidConfigException extends \Exception
{
    /**
     * ApiKeyRequiredException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "Invalid Config", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
