# Persian Converter Library

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/techecosystem/parsify-php.svg?style=flat-square)](https://packagist.org/packages/techecosystem/parsify-php)
[![Total Downloads](https://img.shields.io/packagist/dt/techecosystem/parsify-php.svg?style=flat-square)](https://packagist.org/packages/techecosystem/parsify-php)

The **Persian Converter Library** is a powerful tool designed to handle Persian text conversion, including removing diacritics, converting numbers between English and Persian, and other text normalizations. This library provides an easy-to-use interface for developers to work with Persian text more effectively.

## Features

- Convert English numbers to Persian and vice versa.
- Remove diacritics from Persian text.
- Highly customizable through a fluent builder pattern.
- Lightweight and efficient.

## Installation

To install the library, you can use [Composer][1]:

```bash
composer require techecosystem/parsify-php
```

## API Documentation

### `PersianConverterBuilder Class`

The `PersianConverterBuilder` class provides a fluent interface to create a `PersianConverter` with customizable strategies for text normalization and number conversion.

#### Methods

- **`static create(): self`**  
  - Creates and returns a new instance of the builder.

  - **Example:**

    ``` php
    $builder = PersianConverterBuilder::create();
    ```

- **`withNumberConversion(bool $keepEnglishNumbers = false): self`**
  - Enables number conversion. By default, converts English and Arabic numbers to Persian numbers.

  - #### **Parameters:**

    - `bool $keepEnglishNumbers` (default: `false`): Whether to keep English numbers.

    - If `$keepEnglishNumbers` is `true`, only Arabic numbers are converted.

  - **Example:**

    ``` php
    $builder->withNumberConversion(true);
    ```
  
- **`withTextNormalization(bool $keepPersianDiacritic = true): self`**  
  - Enables text normalization. Optionally keeps Persian diacritics.

  - #### **Parameters:**

    - `bool $keepPersianDiacritic` (default: `true`): Whether to keep Persian diacritics.

  - **Example:**

    ``` php
    $builder->withTextNormalization(false);
    ```

- **`build(): PersianConverter`**  
  - Builds and returns a `PersianConverter` instance with the configured strategies.

  - **Throws:**

    - `MissingStrategyException` If no strategies are enabled, i.e., both text normalization and number conversion are disabled.

  - **Example:**

    ``` php
    $converter = $builder->build();
    ```

### `PersianConverter Class`

The `PersianConverter` class applies various conversion strategies to normalize Persian text and convert numbers.

#### **Methods**

- **`static createDefault(): self`**

  - Creates a default `PersianConverter` with text normalization and Persian number conversion enabled.

  - **Example:**

    ``` php
    $converter = PersianConverter::createDefault();
    ```

- **`convert(string $input): string`**

  - Applies all strategies to the input string and returns the converted text.

  - **Throws:**

    - `TextConversionException` on conversion failure.

  - **Example:**

    ``` php
    $convertedText = $converter->convert("متن فارسی 123");
    ```

### `PersianTextService Class`

The `PersianTextService` class provides utility methods for text normalization using `PersianConverter` with various configurations.

#### Methods

- **`static normalize(string $input): string`**  
  Normalizes the text with default settings (text normalization and Persian number conversion).

  - **Example:**

    ``` php
    $normalizedText = PersianTextService::normalize("متن فارسی 123");
    ```

- **`static normalizeTextWithEnglishNumbers(string $input): string`**  
  - Normalizes the text while keeping English numbers.

  - **Example:**

    ``` php
    $normalizedText = PersianTextService::normalizeTextWithEnglishNumbers("متن فارسی 123");
    ```

- **`static normalizeTextWithoutNumbers(string $input): string`**  
  - Normalizes the text without converting numbers.

  - **Example:**

    ``` php
    $normalizedText = PersianTextService::normalizeTextWithoutNumbers("متن فارسی 123");
    ```

## **Examples**

1. Simple Text Normalization

   ``` php
   echo PersianTextService::normalize("𞸮ﻼم 123 يوﺱ𞺰");
   // Outputs: "سلام ۱۲۳ یوسف"
   ```

2. Normalization with English Numbers

   ``` php
   echo PersianTextService::normalizeTextWithEnglishNumbers("𞸮ﻼم 123 يوﺱ𞺰");
   // Outputs: "سلام 123 یوسف"
   ```

3. Normalization without Number Conversion

   ``` php
   echo PersianTextService::normalizeTextWithoutNumbers("𞸮ﻼم 123 يوﺱ𞺰");
   // Outputs: "سلام 123 یوسف"
   ```

4. Custom Converter: Combining Multiple Conversions

   The library allows chaining multiple conversion rules in one go:

   ``` php
   $converter = PersianConverterBuilder::create()
       ->withTextNormalization(false)
       ->withNumberConversion()
       ->build();
   echo $converter->convert("𞸮ﻼم 123 يوﺱ𞺰");
   // Outputs: "سلام ۱۲۳ یوسف"
   ```

5. Removing Diacritics

   You can also remove diacritics from Persian text using the following approach:

   ``` php
   $converter = PersianConverterBuilder::create()
       ->withTextNormalization(keepPersianDiacritic: false)
       ->build();
   
   $input = "حَتماً";
   echo $converter->convert($input);
   // Outputs: حتما
   ```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## License

This library is open-source software licensed under the [MIT license](LICENSE).


[1]: <https://getcomposer.org/>
