<?php
$reduxOptions = get_option('sabre_redux');
$address = function() use ($reduxOptions) {
    $arr = [];
    foreach ($reduxOptions as $key => $value) {
        if (preg_match('/(address-1|address-2)/', $key)) {
            $arr[$key] = $value;
        }
    }
    return $arr;
};

$data['address'] = $address();


Timber::render('footer.twig', $data);