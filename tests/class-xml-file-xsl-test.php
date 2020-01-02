<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require(__DIR__ . "/class-xml-file-test.php");

final class xml_file_xsl_test extends xml_file_test
{

    public function testReadXML(): void
    {
        $xml = file_get_contents($this->createTestXML());
        $xsl = file_get_contents($this->createTestXSL());
        $result = xml_file::transformXMLXSL_static($xml, $xsl)->saveXML();

        $this->assertTrue(strpos($result, "Name #1,Name #2,Name #3") !== false);
    }
}