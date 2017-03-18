<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

use voku\helper\HtmlMin;

add_filter( 'template_include', 'template_minify_html' );
function template_minify_html( $template ) {
    if ( ! empty( $template ) ) {
        ob_start( 'minify_buffer' );
        include( $template );
        ob_end_flush();
    }
    return false;
}

function minify_buffer( $buffer ) {
    $htmlMin = new HtmlMin();
    $htmlMin->doOptimizeAttributes();                     // optimize html attributes 
    $htmlMin->doRemoveComments();                         // remove default HTML comments
    $htmlMin->doRemoveDefaultAttributes();                // remove defaults
    $htmlMin->doRemoveDeprecatedAnchorName();             // remove deprecated anchor-jump
    $htmlMin->doRemoveDeprecatedScriptCharsetAttribute(); // remove deprecated charset-attribute (the browser will use the charset from the HTTP-Header, anyway)
    $htmlMin->doRemoveDeprecatedTypeFromScriptTag();      // remove deprecated script-mime-types
    $htmlMin->doRemoveDeprecatedTypeFromStylesheetLink(); // remove "type=text/css" for css links
    $htmlMin->doRemoveEmptyAttributes();                  // remove some empty attributes
    $htmlMin->doRemoveHttpPrefixFromAttributes();         // remove optional "http:"-prefix from attributes
    $htmlMin->doRemoveValueFromEmptyInput();              // remove 'value=""' from empty <input>
    $htmlMin->doRemoveWhitespaceAroundTags();             // remove whitespace around tags
    $htmlMin->doSortCssClassNames();                      // sort css-class-names, for better gzip results
    $htmlMin->doSortHtmlAttributes();                     // sort html-attributes, for better gzip results
    $htmlMin->doSumUpWhitespace();                        // sum-up extra whitespace from the Dom
    return $htmlMin->minify( $buffer );
}