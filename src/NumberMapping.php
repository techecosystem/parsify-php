<?php

declare(strict_types=1);

namespace Parsify;

/**
 * Provides number sets for different NumberType enums.
 */
class NumberMapping
{
    /**
     * Constant array of English numbers (0-9).
     */
    private const ENGLISH_NUMBERS = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

    /**
     * Constant array of Persian numbers (۰-۹).
     */
    private const PERSIAN_NUMBERS = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];

    /**
     * Constant array of Arabic numbers (٠-٩).
     */
    private const ARABIC_NUMBERS = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];

    /**
     * @var array
     */
    private static array $numberSets = [];

    /**
     * Returns the corresponding number set for the given NumberType.
     *
     * @param NumberType $type
     *
     * @return string[]
     */
    public static function getNumberSet(NumberType $type): array
    {
        if (!empty(self::$numberSets)) {
            return self::$numberSets[$type->value];
        }

        self::$numberSets = [
            NumberType::ENGLISH->value => self::ENGLISH_NUMBERS,
            NumberType::PERSIAN->value => self::PERSIAN_NUMBERS,
            NumberType::ARABIC->value => self::ARABIC_NUMBERS
        ];

        return self::$numberSets[$type->value];
    }
}
