<?php

declare(strict_types=1);

namespace unit;

use PHPUnit\Framework\TestCase;

class XmlFileTest extends TestCase {

    /**
     * @dataProvider xmlFilepathProvider
     */
    public function testLoad(string $filepath): void {
        $this->assertXmlStringEqualsXmlFile($filepath, '<foo/>');
    }

    public static function xmlFilepathProvider(): array {
        return [
            [__DIR__ . '/../files/valid-1.xml'],
            [__DIR__ . '/../files/valid-2.xml'],
            [__DIR__ . '/../files/invalid.xml'],
        ];
    }
}
