<?php
check_directly_access();

add_filter( 'avatar_defaults', 'gravatar' );
function gravatar( $avatar_defaults ) {
    $myavatar = assets_url( 'img' ) . '/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}
