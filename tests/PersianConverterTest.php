<?php

declare(strict_types=1);

namespace Test;

use Parsify\Exceptions\MissingStrategyException;
use Parsify\Exceptions\TextConversionException;
use Parsify\PersianConverter;
use Parsify\PersianConverterBuilder;
use Parsify\PersianTextService;
use PHPUnit\Framework\TestCase;

class PersianConverterTest extends TestCase
{
    private PersianConverter $defaultConverter;

    protected function setUp(): void
    {
        parent::setUp();
        $this->defaultConverter = PersianConverter::createDefault();
    }

    // Basic Functionality Tests
    public function testDefaultConversion(): void
    {
        $input = 'Hello123 سلام٤٥٦';
        $expected = 'Hello۱۲۳ سلام۴۵۶';
        $result = $this->defaultConverter->convert($input);
        $this->assertEquals($expected, $result);
    }

    public function testEmptyStringThrowsException(): void
    {
        $this->expectException(TextConversionException::class);
        $this->defaultConverter->convert('');
    }

    // Number Conversion Tests
    public function testEnglishToPersianNumbers(): void
    {
        $converter = PersianConverterBuilder::create()
            ->withNumberConversion()
            ->build();

        $input = '0123456789';
        $expected = '۰۱۲۳۴۵۶۷۸۹';
        $this->assertEquals($expected, $converter->convert($input));
    }

    public function testArabicToPersianNumbers(): void
    {
        $converter = PersianConverterBuilder::create()
            ->withNumberConversion()
            ->build();

        $input = '٠١٢٣٤٥٦٧٨٩';
        $expected = '۰۱۲۳۴۵۶۷۸۹';
        $this->assertEquals($expected, $converter->convert($input));
    }

    public function testKeepEnglishNumbers(): void
    {
        $converter = PersianConverterBuilder::create()
            ->withNumberConversion(keepEnglishNumbers: true)
            ->build();

        $input = 'Hello123 سلام٤٥٦';
        $expected = 'Hello123 سلام456';
        $this->assertEquals($expected, $converter->convert($input));
    }

    // Text Normalization Tests
    public function testArabicLetterConversion(): void
    {
        $converter = PersianConverterBuilder::create()
            ->withTextNormalization()
            ->build();

        $input = 'ي ك دِ بِ زِ ذِ شِ سِ ى ة';
        $expected = 'ی ک د ب ز ذ ش س ی ه';
        $this->assertEquals($expected, $converter->convert($input));
    }

    public function testSpecialCharacterConversion(): void
    {
        $converter = PersianConverterBuilder::create()
            ->withTextNormalization()
            ->build();

        $input = 'ؠ ؽ ؾ ؿ ۾ ﮥ ﮦ ﮩ ﮨ ﮪ ﮫ ﮬ';
        $expected = 'ی ی ی ی م ه ه ه ه ه ه ه';
        $this->assertEquals($expected, $converter->convert($input));
    }

    public function testPersianDiacriticsRemoval(): void
    {
        $converter = PersianConverterBuilder::create()
            ->withTextNormalization(keepPersianDiacritic: false)
            ->build();

        $input = 'حَتماً';
        $expected = 'حتما';
        $this->assertEquals($expected, $converter->convert($input));

        $converter2 = PersianConverterBuilder::create()
            ->withTextNormalization(keepPersianDiacritic: true)
            ->build();

        $input2 = 'حَتماً';
        $this->assertEquals($input2, $converter2->convert($input2));
    }

    public function testLigatureConversion(): void
    {
        $converter = PersianConverterBuilder::create()
            ->withTextNormalization()
            ->build();

        $input = 'ﻵ ﻶ ﻷ ﻸ ﻹ ﻺ ﻻ ﻼ ﷲ ﷼';
        $expected = 'لا لا لا لا لا لا لا لا الله ریال';
        $this->assertEquals($expected, $converter->convert($input));
    }

    // Builder Pattern Tests
    public function testBuilderWithoutAnyStrategy(): void
    {
        $this->expectException(MissingStrategyException::class);
        PersianConverterBuilder::create()
            ->build();
    }

    public function testBuilderWithAllOptions(): void
    {
        $converter = PersianConverterBuilder::create()
            ->withTextNormalization()
            ->withNumberConversion(keepEnglishNumbers: true)
            ->build();

        $input = 'Hello123 سلام٤٥٦ يك';
        $expected = 'Hello123 سلام456 یک';
        $this->assertEquals($expected, $converter->convert($input));
    }

    // Performance Tests
    public function testPerformanceWithLargeInput(): void
    {
        $input = str_repeat('Hello123 سلام٤٥٦ يك ', 1000);

        $startTime = microtime(true);
        $this->defaultConverter->convert($input);
        $endTime = microtime(true);

        // Conversion should take less than 0.01 second
        $this->assertLessThan(0.01, $endTime - $startTime);
    }

    // Integration Tests
    public function testCompleteWorkflow(): void
    {
        $service = new PersianTextService();

        // Test all service methods
        $input = 'Hello123 سلام٤٥٦ يك';

        $result1 = $service->normalize($input);
        $this->assertEquals('Hello۱۲۳ سلام۴۵۶ یک', $result1);

        $result2 = $service->normalizeTextWithEnglishNumbers($input);
        $this->assertEquals('Hello123 سلام456 یک', $result2);

        $result3 = $service->normalizeTextWithoutNumbers($input);
        $this->assertEquals('Hello123 سلام٤٥٦ یک', $result3);
    }
}
