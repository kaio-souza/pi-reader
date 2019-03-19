<?php

namespace Kaleu62\PIReader\Services;

use Kaleu62\PIReader\Helpers\Helper;
use \Smalot\PdfParser\Parser;


class ServiceParsePDF extends Parser
{
    /**
     * @var array
     */
    private $matchesPerPage = [];

    /**
     * @param $archivePath
     * @return array
     * @throws \Exception
     */
    private function loadDataPDF($archivePath)
    {
        try
        {
            @$pdf = $this->parseFile($archivePath);
        }
        catch (\Exception $e)
        {
            return [];
        }

        try
        {
            $pages = $pdf->getPages();
        }
        catch (\Exception $e)
        {
            return [];
        }

        if (!is_array($pages)) return [];

        foreach ($pages as $page)
        {
            $this->matchesPerPage[] = $page->gettext();

            //            $match = false;
            //            $string = $this->prepairString($page->gettext());
            //            if ($string) $match = $this->getNumberLine($string);
            //
            //            if ($match) $this->matchesPerPage[] = $match;
        }

        return $this->matchesPerPage;
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