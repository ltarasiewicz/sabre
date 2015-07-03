<?php use Roots\Sage\Nav\NavWalker; ?>

<?php
global $query_string;
$hasTitleStrap = ! is_front_page(); // title strap displayed everywhere but on the HP
$site = Timber::get_context();
$context['site'] = $site;
$context['hasTitleStrap'] = $hasTitleStrap;
$context['homePage'] = false;
$context['header_image'] = get_header_image();
if (is_front_page()) {
    $context['homePage'] = get_post();
}
Timber::render('header.twig', $context);
