<?php

/*
 * Fix path for WPML theme scanner
 *
 * Thanks to all WPML's developers for not using filters, you make me do bad things...
 */

add_action( 'wpml_st_loaded', 'remove_wpml_scan_theme_for_strings', 100 );
function remove_wpml_scan_theme_for_strings() {
    global $WPML_String_Translation;
    remove_action( 'wpml_scan_theme_for_strings', array( $WPML_String_Translation, 'scan_theme_for_strings' ), 10 );
    add_action( 'wpml_scan_theme_for_strings', 'scan_skeleton_theme_for_strings', 10 );
}

add_action( 'init', 'remove_wp_ajax_st_theme_localization_rescan', 100 );
function remove_wp_ajax_st_theme_localization_rescan() {
    global $WPML_String_Translation;
    remove_action( 'wp_ajax_st_theme_localization_rescan', array( $WPML_String_Translation, 'scan_theme_for_strings' ), 10 );
    add_action( 'wp_ajax_st_theme_localization_rescan', 'scan_skeleton_theme_for_strings', 10 );
}

function scan_skeleton_theme_for_strings() {

    if ( ! class_exists( 'WPML_Skeleton_String_Scanner' ) ) {
        
		require_once WPML_ST_PATH . '/inc/gettext/wpml-theme-string-scanner.class.php';

        class WPML_Skeleton_String_Scanner extends WPML_Theme_String_Scanner {

            public function scan( $no_echo ) {

                $this->current_type = 'theme';

                $string_settings = apply_filters( 'wpml_get_setting', false, 'st' );
                if ( isset( $_POST[ 'auto_text_domain' ] ) && $_POST[ 'auto_text_domain' ] ) {
                    $string_settings[ 'use_header_text_domains_when_missing' ] = 1;
                } else {
                    $string_settings[ 'use_header_text_domains_when_missing' ] = 0;
                }
                do_action( 'wpml_set_setting', 'st', $string_settings, true );

                $this->scan_starting( 'theme ' );
                
                $this->current_path = SRC_DIR . '/views';

                $theme_info  = wp_get_theme();
                $text_domain = $theme_info->get( 'TextDomain' );
                $this->init_text_domain( $text_domain );

                $this->scan_theme_files();

                $theme_localization_domains = array();
                if(isset($string_settings[ 'theme_localization_domains' ])) {
                    $theme_localization_domains = $string_settings[ 'theme_localization_domains' ];
                }

                if ( isset( $_POST[ 'icl_load_mo' ] ) && $_POST[ 'icl_load_mo' ] ) {
                    $this->add_translations( $theme_localization_domains, '' );
                }
                $this->copy_old_translations( $theme_localization_domains, 'theme' );
                $this->cleanup_wrong_contexts( );

                if ( $theme_info && ! is_wp_error( $theme_info ) ) {
                    $this->remove_notice( $theme_info->get( 'Name' ) );
                }

                if ( ! $no_echo ) {
                    $this->scan_response();
                }
            }

            private function scan_theme_files( $dir_or_file = false, $recursion = 0 ) {
                require_once WPML_ST_PATH . '/inc/potx.php';
                global $sitepress, $sitepress_settings;

                if ( $dir_or_file === false ) {
                    $dir_or_file = $this->current_path;
                }
                $this->add_stat( sprintf( __( 'Scanning theme folder: %s', 'wpml-string-translation' ), $dir_or_file ), true );

                $dh = opendir( $dir_or_file );
                while ( $dh && false !== ( $file = readdir( $dh ) ) ) {
                    if ( 0 === strpos( $file, '.' ) ) {
                        continue;
                    }

                    if ( is_dir( $dir_or_file . "/" . $file ) ) {
                        $recursion ++;
                        $this->add_stat( str_repeat( "\t", $recursion ) . sprintf( __( 'Opening folder: %s', 'wpml-string-translation' ), $dir_or_file . "/" . $file ) );
                        $this->scan_theme_files( $dir_or_file . "/" . $file, $recursion );
                        $recursion --;
                    } elseif ( preg_match( '#(\.php|\.inc)$#i', $file ) ) {
                        // THE potx way
                        $this->add_stat( str_repeat( "\t", $recursion ) . sprintf( __( 'Scanning file: %s', 'wpml-string-translation' ), $dir_or_file . "/" . $file ) );
                        $this->add_scanned_file( $dir_or_file . "/" . $file );
                        _skeleton_potx_process_file( $dir_or_file . "/" . $file, 0, array( $this, 'store_results' ), '_potx_save_version', $this->get_default_domain() );
                    } else {
                        $this->add_stat( str_repeat( "\t", $recursion ) . sprintf( __( 'Skipping file: %s', 'wpml-string-translation' ), $dir_or_file . "/" . $file ) );
                    }
                }

                if ( $dir_or_file == TEMPLATEPATH && TEMPLATEPATH != STYLESHEETPATH ) {
                    $this->scan_theme_files( STYLESHEETPATH );
                    $double_scan = false;
                }

                if ( ! $recursion && ( empty( $double_scan ) || ! $double_scan ) ) {
                    global $__icl_registered_strings;
                    $this->add_stat( __( 'Done scanning files', 'wpml-string-translation' ) );

                    $sitepress_settings[ 'st' ][ 'theme_localization_domains' ] = array_keys( $this->get_domains_found() );
                    $sitepress->save_settings( $sitepress_settings );
                    closedir( $dh );

                    $scanned_files = join( '</li><li>', $this->get_scanned_files() );
                    $pre_stat      = __( '= Your theme was scanned for texts =', 'wpml-string-translation' ) . '<br />';
                    $pre_stat .= __( 'The following files were processed:', 'wpml-string-translation' ) . '<br />';
                    $pre_stat .= '<ol style="font-size:10px;"><li>' . $scanned_files;
                    $pre_stat .= '</li></ol>';
                    $pre_stat .= sprintf( __( 'WPML found %s strings. They were added to the string translation table.', 'wpml-string-translation' ), count( $__icl_registered_strings ) );
                    $pre_stat .= '<br /><a href="#" onclick="jQuery(this).next().toggle();return false;">' . __( 'More details', 'wpml-string-translation' ) . '</a>';
                    $pre_stat .= '<textarea style="display:none;width:100%;height:150px;font-size:10px;">';
                    $this->add_stat( $pre_stat, true );
                    $this->add_stat( '</textarea>' );
                }
            }
            
        }

        function _skeleton_potx_process_file($file_path,
                                    $strip_prefix = 0,
                                    $save_callback = '_potx_save_string',
                                    $version_callback = '_potx_save_version',
                                    $default_domain = '') {

        global $_potx_tokens, $_potx_lookup;

        // Always grab the CVS version number from the code
            if ( !wpml_st_file_path_is_valid( $file_path ) ) {
                return;
            }
        $code = file_get_contents($file_path);
        $file_name = $strip_prefix > 0 ? substr($file_path, $strip_prefix) : $file_path;
        _potx_find_version_number($code, $file_name, $version_callback);

        // Extract raw PHP language tokens.
        $raw_tokens = token_get_all($code);
        unset($code);

        // Remove whitespace and possible HTML (the later in templates for example),
        // count line numbers so we can include them in the output.
        $_potx_tokens = array();
        $_potx_lookup = array();
        $token_number = 0;
        $line_number = 1;
                // Fill array for finding token offsets quickly.
                $src_tokens = array(
                    '__', 'esc_attr__', 'esc_html__', '_e', 'esc_attr_e', 'esc_html_e',
                    '_x', 'esc_attr_x', 'esc_html_x', '_ex',
                    '_n', '_nx', '_t'
                );
        foreach ($raw_tokens as $token) {
            if ((!is_array($token)) || (($token[0] != T_WHITESPACE) && ($token[0] != T_INLINE_HTML))) {
            if (is_array($token)) {
                $token[] = $line_number;

                if ($token[0] == T_STRING || ($token[0] == T_VARIABLE && in_array($token[1], $src_tokens))) {
                if (!isset($_potx_lookup[$token[1]])) {
                    $_potx_lookup[$token[1]] = array();
                }
                $_potx_lookup[$token[1]][] = $token_number;
                }
            }
            $_potx_tokens[] = $token;
            $token_number++;
            }
            // Collect line numbers.
            if (is_array($token)) {
            $line_number += count(explode("\n", $token[1])) - 1;
            }
            else {
            $line_number += count(explode("\n", $token)) - 1;
            }
        }
        unset($raw_tokens);

        if(!empty($src_tokens))
        foreach($src_tokens as $tk){
            _potx_find_t_calls_with_context($file_name, $save_callback, $tk, $default_domain);
        }

        }

    }

    $scan_for_strings = new WPML_Skeleton_String_Scanner( wp_filesystem_init() );
    $scan_for_strings->scan( false );

}