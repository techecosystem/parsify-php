<?php

declare(strict_types=1);

namespace Parsify;

/**
 * Class PersianTextService
 *
 * Provides methods for text normalization with various configurations using PersianConverter.
 */
class PersianTextService
{
    /**
     * Normalizes text with default settings (text normalization and Persian number conversion).
     *
     * @param string $input
     *
     * @return string
     */
    public static function normalize(string $input): string
    {
        $converter = PersianConverter::createDefault();
        return $converter->convert($input);
    }

    /**
     * Normalizes text while keeping English numbers.
     *
     * @param string $input
     *
     * @return string
     */
    public static function normalizeTextWithEnglishNumbers(string $input): string
    {
        // Custom conversion keeping English numbers
        $converter = PersianConverterBuilder::create()
            ->withTextNormalization()
            ->withNumberConversion(keepEnglishNumbers: true)
            ->build();
        return $converter->convert($input);
    }

    /**
     * Normalizes text without converting numbers.
     *
     * @param string $input
     *
     * @return string
     */
    public static function normalizeTextWithoutNumbers(string $input): string
    {
        // Only normalize text without number conversion
        $converter = PersianConverterBuilder::create()
            ->withTextNormalization()
            ->build();
        return $converter->convert($input);
    }
}
