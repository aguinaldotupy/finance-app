<?php

$finder = PhpCsFixer\Finder::create()
    ->exclude('bootstrap/cache')
    ->exclude('storage')
    ->exclude('vendor')
    ->in(__DIR__)
    ->name('*.php')
    ->notName('*_ide_helper.php')
    ->notName('*.blade.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);
return PhpCsFixer\Config::create()
    ->setCacheFile(__DIR__ . '/.php_cs.cache')
    ->setRules([
        '@PSR1' => true,
        '@PSR2' => true,
        'array_syntax' => [
            'syntax' => 'short',
        ],
        'blank_line_after_opening_tag' => true,
        'braces' => [
            'allow_single_line_closure' => false,
            'position_after_anonymous_constructs' => 'same',
            'position_after_control_structures' => 'same',
            'position_after_functions_and_oop_constructs' => 'next',
        ],
        'concat_space' => [
            'spacing' => 'one',
        ],
        'function_typehint_space' => true,
        'no_blank_lines_after_class_opening' => true,
        'no_unused_imports' => true,
        'no_useless_else' => true,
        'no_useless_return' => true,
        'no_trailing_comma_in_list_call' => false,
        'no_trailing_comma_in_singleline_array' => false,
        'not_operator_with_successor_space' => true,
        'ordered_imports' => true,
        'phpdoc_order' => true,
        'phpdoc_scalar' => true,
        'phpdoc_single_line_var_spacing' => true,
        'phpdoc_summary' => true,
        'short_scalar_cast' => true,
        'single_blank_line_before_namespace' => true,
        'ternary_operator_spaces' => true,
        'trailing_comma_in_multiline_array' => true,
        'yoda_style' => false,
    ])
    ->setFinder($finder);
