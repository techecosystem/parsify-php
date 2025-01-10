<?php

declare(strict_types=1);

namespace Parsify;

/**
 * Class TextConversionStrategy
 *
 * Converts text by normalizing Arabic script to Persian and handling special characters.
 */
readonly class TextConversionStrategy implements ConversionStrategy
{
    /**
     * @param bool $keepPersianDiacritic
     */
    public function __construct(
        private bool $keepPersianDiacritic = true
    ) {
        //
    }

    /**
     * {@inheritdoc}
     */
    public function convert(string $input): string
    {
        $map = CharacterMapping::getMapping(
            includePersianDiacritic: !$this->keepPersianDiacritic
        );

        return strtr($input, $map);
    }
}
