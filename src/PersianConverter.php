<?php

declare(strict_types=1);

namespace Parsify;

use InvalidArgumentException;
use Parsify\Exceptions\TextConversionException;

/**
 * Class PersianConverter
 *
 * Applies multiple conversion strategies to normalize Persian text and convert numbers.
 */
readonly class PersianConverter
{
    /**
     * Initializes the converter with an array of ConversionStrategy objects.
     *
     * @param ConversionStrategy[] $strategies
     *
     * @throws InvalidArgumentException if no strategies are provided.
     */
    public function __construct(private array $strategies)
    {
        if (empty($strategies)) {
            throw new InvalidArgumentException('At least one conversion strategy is required');
        }
    }

    /**
     * Creates a default PersianConverter with text normalization and Persian number conversion enabled.
     *
     * @return self
     */
    public static function createDefault(): self
    {
        return PersianConverterBuilder::create()
            ->withTextNormalization()
            ->withNumberConversion()
            ->build();
    }

    /**
     * Applies all strategies to the input string and returns the converted text.
     *
     * @param string $input
     *
     * @return string
     * @throws TextConversionException on conversion failure.
     */
    public function convert(string $input): string
    {
        try {
            $text = PersianText::fromString($input);

            foreach ($this->strategies as $strategy) {
                $text = PersianText::fromString($strategy->convert($text->toString()));
            }

            return $text->toString();
        } catch (InvalidArgumentException $e) {
            throw new TextConversionException('Failed to convert text: ' . $e->getMessage());
        }
    }
}
