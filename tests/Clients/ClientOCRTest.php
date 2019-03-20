<?php

namespace Kaleu62\PIReader\Clients;


use PHPUnit\Framework\TestCase;

class ClientOCRTest extends TestCase
{
    public function test_if_save_pid(){
        $clientOCR = new ClientOCR();
        $savePidStatus = $clientOCR->savePid('1');
        $this->assertEquals(true, $savePidStatus);
    }
}
