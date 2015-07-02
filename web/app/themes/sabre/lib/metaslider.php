<?php

add_filter('metaslider_flex_slider_parameters', 'metaslider_flex_params', 10, 3);

function metaslider_flex_params($options, $slider_id, $settings) {
    if ($slider_id == 51) {
        $options['maxItems'] = 3;
    }
    return $options;
}
