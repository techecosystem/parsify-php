<?php

declare(strict_types=1);

namespace Parsify;

use InvalidArgumentException;

/**
 * Class PersianText
 *
 * Represents a text object that ensures the value is non-empty.
 */
readonly class PersianText
{
    /**
     * Constructor to initialize the PersianText object.
     *
     * @param string $value
     *
     * @throws InvalidArgumentException if the value is empty.
     */
    private function __construct(private string $value)
    {
        if (empty($value)) {
            throw new InvalidArgumentException('Text value cannot be empty');
        }
    }

    /**
     * Static factory method to create a PersianText object from a string.
     *
     * @param string $value
     *
     * @return self
     */
    public static function fromString(string $value): self
    {
        return new self($value);
    }

    /**
     * Returns the string value of the PersianText object.
     *
     * @return string
     */
    public function toString(): string
    {
        return $this->value;
    }
}
