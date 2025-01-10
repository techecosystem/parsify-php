<?php

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$finder = Finder::create()
    ->in([
        'src',
        'tests',
    ])
    ->name('*.php')
    ->exclude('vendor')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

return (new Config())
    ->setRules([
        '@PSR12' => true,
        'strict_param' => true,
        'array_syntax' => ['syntax' => 'short'],
        'declare_strict_types' => true,
        'no_unused_imports' => true,
        'single_quote' => true,
        'no_extra_blank_lines' => true,
        'array_indentation' => true,
        'cast_spaces' => true,
        'phpdoc_align' => [
            'align' => 'vertical',
        ],
        'phpdoc_order' => [
            'order' => ['param', 'return', 'throws'],
        ],
        'single_line_empty_body' => false,
    ])
    ->setFinder($finder);
