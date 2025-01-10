<?php

declare(strict_types=1);

namespace Parsify;

/**
 * Enum NumberType
 *
 * Defines the different types of number formats that can be used in the conversion.
 */
enum NumberType: string
{
    case ENGLISH = 'english';
    case PERSIAN = 'persian';
    case ARABIC = 'arabic';
}
