<?php

require_once(__DIR__ . "/class-test-base.php");

final class xml_write_test extends test_base
{

    public function testWriteNewItemToXML(): void
    {
        $text = "Item #5";
        $text2 = "Extra Large";
        $text3 = "Unknown";
        $tmp = $this->createTestXML();
        $subject = new xml_file($tmp);

        $subject->set("//items/item[@id=5]/name", $text);
        $subject->set("//items/item[@id=5]/size", $text2);
        $subject->set("//items/item[@id=5]/extra", $text3);

        $result = $subject->get("/items/item[@id=5]/name");
        $result2 = $subject->get("/items/item[@id=5]/size");
        $result3 = $subject->get("/items/item[@id=5]/extra");

        $this->assertEquals($text, $result);
        $this->assertEquals($text2, $result2);
        $this->assertEquals($text3, $result3);
    }

    public function testOverwriteXMLField(): void
    {
        $text = "Item ###";
        $tmp = $this->createTestXML();
        $subject = new xml_file($tmp);

        $subject->set("//items/item[@id=2]/name", $text);

        $result = $subject->get("//items/item[@id=2]/name");

        $this->assertEquals($text, $result);
    }

    public function testOverwriteXMLFieldBySequence(): void
    {
        $text = "Item ###";
        $tmp = $this->createTestXML();
        $subject = new xml_file($tmp);

        $subject->set("//items/item[2]/name", $text);

        $result = $subject->get("//items/item[@id=2]/name");

        $this->assertEquals($text, $result);
    }

    public function testDeleteElement(): void
    {
        $tmp = $this->createTestXML();
        $subject = new xml_file($tmp);

        $subject->del("//items/item[@id=2]", "");

        $result = $subject->get("//items/item[@id=2]/name");

        $this->assertEquals("", $result);
    }
}
