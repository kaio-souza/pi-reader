<?php

namespace Kaleu62\PIReader\Services;

use Kaleu62\PIReader\Helpers\Helper;
use Spatie\PdfToText\Pdf;


class ParsePDFService
{
        /**
     * @param $archivePath
     * @return array
     * @throws \Exception
     */
    private function loadDataPDF($archivePath)
    {
        try
        {
            $temp = tempnam(sys_get_temp_dir(), 'TMP_FILE_IN_');
            $file = file_get_contents($archivePath);
            file_put_contents($temp, $file);
            $pages = [Pdf::getText($temp)];
        }
        catch (\Exception $e)
        {
            return [];
        }

        if (!is_array($pages)) return [];

        return $pages;
    }


    /**
     * @param $archivePath
     * @return array
     * @throws \Exception
     */
    final public function getFileText($archivePath)
    {
        return $this->loadDataPDF($archivePath);
    }
}