<?php

declare(strict_types=1);

namespace Parsify;

/**
 * Interface ConversionStrategy
 *
 * Defines a contract for implementing different conversion strategies.
 * Classes implementing this interface should provide a mechanism to convert
 * numbers within a string from a specified source format to a target format.
 *
 * This can be used for various types of number conversions such as:
 * - Converting between different numeral systems (e.g., Arabic to Persian).
 * - Formatting numbers according to specific locale or cultural standards.
 *
 * Example usage:
 * - Implementations could convert "123" in English to "۱۲۳" in Persian.
 */
interface ConversionStrategy
{
    /**
     * Converts the numbers in the input string from the source format to the target format.
     *
     * @param string $input
     *
     * @return string
     */
    public function convert(string $input): string;
}
