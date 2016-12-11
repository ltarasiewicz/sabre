<?php

add_filter('get_twig', 'gmwAddFilter');

function gmwAddFilter($twig) {

    $twig->addExtension(new Twig_Extension_StringLoader());
    $twig->addFilter('seconds_to_date', new Twig_SimpleFilter('seconds_to_date', 'timestampToPrettyDate'));
    return $twig;
}

function timestampToPrettyDate($seconds, $format) {
    return date($format, $seconds);
}
