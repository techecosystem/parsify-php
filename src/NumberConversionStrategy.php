<?php

declare(strict_types=1);

namespace Parsify;

/**
 * Converts numbers between different formats (e.g., English to Persian).
 */
readonly class NumberConversionStrategy implements ConversionStrategy
{
    /**
     * Constructor to initialize the strategy with source and target number formats.
     *
     * @param NumberType $from
     * @param NumberType $to
     */
    public function __construct(
        private NumberType $from,
        private NumberType $to
    ) {
        //
    }

    /**
     * {@inheritdoc}
     */
    public function convert(string $input): string
    {
        $fromSet = NumberMapping::getNumberSet($this->from);
        $toSet = NumberMapping::getNumberSet($this->to);

        return strtr($input, array_combine($fromSet, $toSet));
    }
}
