<?php

declare(strict_types=1);

namespace Parsify;

use Parsify\Exceptions\MissingStrategyException;

/**
 * Class PersianConverterBuilder
 *
 * Builds a PersianConverter with customizable conversion strategies.
 */
class PersianConverterBuilder
{
    private bool $convertNumbers = false;
    private bool $normalizeText = false;
    private bool $keepEnglishNumbers = false;
    private bool $keepPersianDiacritic = true;
    private array $strategies = [];

    /**
     * Create new PersianConverterBuilder
     *
     * @return self
     */
    public static function create(): self
    {
        return new self();
    }

    /**
     * Enables or disables number conversion.
     *
     * @param bool $keepEnglishNumbers
     *
     * @return self
     */
    public function withNumberConversion(
        bool $keepEnglishNumbers = false
    ): self {
        $this->convertNumbers = true;
        $this->keepEnglishNumbers = $keepEnglishNumbers;
        return $this;
    }

    /**
     * Enables or disables text normalization.
     *
     * @param bool $keepPersianDiacritic
     *
     * @return self
     */
    public function withTextNormalization(
        bool $keepPersianDiacritic = true
    ): self {
        $this->normalizeText = true;
        $this->keepPersianDiacritic = $keepPersianDiacritic;
        return $this;
    }

    /**
     * Builds and returns a PersianConverter with the configured strategies.
     *
     * This method finalizes the configuration of the PersianConverter by applying
     * the selected text normalization and number conversion strategies. At least
     * one strategy must be enabled for the converter to function properly.
     *
     * @return PersianConverter The configured PersianConverter instance.
     *
     * @throws MissingStrategyException If no strategies are enabled, i.e., both
     *                                  text normalization and number conversion are
     *                                  disabled.
     */
    public function build(): PersianConverter
    {
        if (!$this->normalizeText && !$this->convertNumbers) {
            throw new MissingStrategyException(
                'You must enable at least one strategy: text normalization or number conversion.'
            );
        }

        if ($this->normalizeText) {
            $this->strategies[] = new TextConversionStrategy(
                $this->keepPersianDiacritic
            );
        }

        if ($this->convertNumbers) {
            if (!$this->keepEnglishNumbers) {
                $this->strategies[] = new NumberConversionStrategy(
                    NumberType::ENGLISH,
                    NumberType::PERSIAN
                );
            } else {
                $this->strategies[] = new NumberConversionStrategy(
                    NumberType::PERSIAN,
                    NumberType::ENGLISH
                );
            }
            $this->strategies[] = new NumberConversionStrategy(
                NumberType::ARABIC,
                $this->keepEnglishNumbers ? NumberType::ENGLISH : NumberType::PERSIAN
            );
        }

        return new PersianConverter($this->strategies);
    }
}
