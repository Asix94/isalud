<?php

declare(strict_types=1);

namespace App\Tests\PorfolioClients\Domain\Service;

use App\PorfolioClients\Domain\Customer;
use App\PorfolioClients\Domain\Customers;
use App\PorfolioClients\Domain\Service\XmlConverter;
use PHPUnit\Framework\TestCase;

use SimpleXMLElement;

use function dump;

final class XmlConverterTest extends TestCase
{
    /**
     * @covers XmlConverterTest
     */
    public function testXmlConversion(): void
    {
        $xml = '<customers><customer name="John Doe" phone="555-555-5555" company="ACME">johndoe@example.com</customer></customers>';
        $expected = Customers::create([
                                          Customer::create("John Doe", "johndoe@example.com", "555-555-5555", "ACME"),
                                      ]);

        $simpleXml = $this->createMock(SimpleXMLElement::class);
        $xml = $simpleXml->expects($this->once())->method('simplexml_load_string')->willReturn([]);
        dump($xml); die;

        $xmlConverter = new XmlConverter();
        $actual = $xmlConverter($xml);
        dump($actual); die;

        $this->assertEquals($expected, $actual);
    }
}
