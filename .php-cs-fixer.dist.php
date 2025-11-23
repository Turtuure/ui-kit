<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__ . '/src')
    ->in(__DIR__ . '/tests')
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR12' => true,
        'array_syntax' => ['syntax' => 'short'],
        'declare_strict_types' => true,
        'no_unused_imports' => true,
        'ordered_imports' => [
            'sort_algorithm' => 'alpha',
            'imports_order' => ['const', 'function', 'class'],
        ],
        'single_line_empty_body' => false, // Allow empty lines in class/function bodies
        'fully_qualified_strict_types' => true,
        'blank_line_after_namespace' => true,
        'blank_line_after_opening_tag' => true,
        'cast_spaces' => true,
        'compact_nullable_typehint' => true,
        'concat_space' => ['spacing' => 'none'],
        'function_declaration' => [
            'closure_fn_spacing' => 'none',
            'preserve_multi_line_paren', // Default option
        ],
        'include' => true,
        'lambda_not_used_import' => true,
        'linebreak_after_opening_tag' => true,
        'magic_constant_casing' => true,
        'magic_method_casing' => true,
        'method_argument_space' => [
            'on_multiline' => 'ensure_fully_multiline',
            'after_heredoc' => false,
        ],
        'native_function_casing' => true,
        'native_function_type_declaration_casing' => true,
        'no_alias_language_construct_call' => true,
        'no_alternative_syntax' => true,
        'no_blank_lines_after_class_opening' => true,
        'no_blank_lines_after_phpdoc' => true,
        'no_empty_comment' => true,
        'no_empty_phpdoc' => true,
        'no_empty_statement' => true,
        'no_leading_namespace_whitespace' => true,
        'no_multiline_whitespace_around_double_arrow' => true,
        'no_trailing_comma_in_singleline' => true,
        'no_whitespace_in_blank_line' => true,
        'normalize_index_brace' => true,
        'operator_linebreak' => true,
        'return_type_declaration' => ['space_before_colon' => 'none'],
        'short_scalar_cast' => true,
        'space_after_semicolon' => true,
        'standardize_not_equals' => true,
        'trailing_comma_in_multiline' => true,
        'trim_array_spaces' => true,
        'type_declaration_spaces' => true,
        'whitespace_after_comma_in_array' => true,
    ])
    ->setFinder($finder)
;