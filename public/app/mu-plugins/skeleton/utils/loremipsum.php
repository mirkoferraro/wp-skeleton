<?php

function loremipsum( $length = 100, $paragraphs = true, $echo = true ) {
    
    $available_texts = array(
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, libero sed semper vestibulum, ex nisi lobortis mauris, ac tempor ligula massa nec mauris. Mauris nec massa sapien. Aenean non interdum nisi. Pellentesque facilisis finibus ligula ut lacinia. Suspendisse quis imperdiet mauris, eget tristique velit. Vestibulum leo felis, lacinia ac sapien id, dapibus posuere metus. Sed volutpat dapibus lacinia. Aenean vitae est est.',
		'Curabitur augue leo, tempus sit amet finibus in, maximus id enim. Morbi libero orci, scelerisque ac commodo consectetur, tempor ultricies ipsum. Integer at diam eu mi hendrerit consectetur. Maecenas sit amet condimentum mi, in laoreet purus. Mauris semper, ante ut aliquet facilisis, mauris tellus fringilla velit, eget sollicitudin lacus urna sed risus. Suspendisse potenti. Suspendisse vitae sollicitudin elit. In dictum lorem et justo efficitur interdum.',
		'Phasellus auctor accumsan dignissim. In auctor magna a metus malesuada, quis gravida neque vestibulum. In gravida enim non orci tincidunt venenatis. Praesent venenatis, lectus aliquam convallis euismod, urna mi fringilla purus, sed porttitor turpis nisi vitae tortor. Vivamus tincidunt libero at lorem mattis, sed egestas lectus ornare. Proin et rhoncus leo. Quisque sit amet risus metus. Nunc porta nunc lacus, at auctor turpis pulvinar vitae. Donec consequat congue tortor eu eleifend. Aenean placerat, nisi quis ultrices hendrerit, sapien diam consectetur eros, efficitur tincidunt diam nisl non ipsum. Pellentesque vel turpis nibh. Donec commodo justo ac tempus lacinia. Donec fringilla libero risus, quis dictum arcu mattis et. Sed lectus nulla, tempor sed venenatis ut, ornare at velit. Sed volutpat enim nec felis rhoncus, vitae porttitor nunc faucibus. Nullam orci lacus, vulputate eget dolor vel, feugiat imperdiet dolor.',
		'Nam in justo a felis consequat eleifend et quis nunc. Curabitur at iaculis elit. Praesent aliquam risus at scelerisque varius. Nulla facilisi. Cras mauris nulla, auctor vitae auctor a, feugiat egestas enim. Nam sodales ante lacus, quis accumsan ex placerat ac. Donec auctor, massa gravida porttitor placerat, nisi ex dictum neque, a ornare arcu leo vel quam. Duis vehicula consequat sagittis. Suspendisse nec nisl varius, lobortis lacus nec, condimentum neque. Nam vel hendrerit sapien. Suspendisse urna neque, interdum at faucibus vitae, dapibus nec mi. Donec nisl ligula, accumsan at rhoncus sit amet, suscipit non sem.',
		'Donec aliquam ante ac libero vulputate lacinia. Suspendisse accumsan eget velit ac egestas. Etiam tincidunt, lorem eget pharetra condimentum, ante nisi tincidunt odio, sed sollicitudin quam tellus sit amet mi. Aliquam ac turpis nec lorem ullamcorper vulputate et at ante. Fusce ac risus vel sem bibendum fringilla. Nulla pulvinar bibendum eros, id pretium dui congue non. Curabitur posuere metus nec risus rutrum blandit. Sed hendrerit neque vel blandit laoreet. Integer sollicitudin orci et enim consectetur placerat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse varius eleifend facilisis. Vestibulum sagittis ultricies urna vel elementum. Ut accumsan nisl nec pulvinar elementum. Aenean id dolor rhoncus, dictum elit eget, pellentesque dolor. Proin sit amet tristique ligula. Nam id nulla est.'
    );

    $texts = array();

    $i = 0;
    while( $length > 0 ) {
        $text = $available_texts[$i % count($available_texts)];
        $text = substr( $text, 0, $length );

        $texts[] = $text;
        $length -= strlen( $text );
        $i++;
    }

    if ( $paragraphs ) {
        $texts = array_map( function( $text ) {
            return "<p>$text</p>";
        }, $texts);
    }

    $texts = implode( " ", $texts );

    if ( ! $echo ) {
        return $texts;
    }

    echo $texts;
}