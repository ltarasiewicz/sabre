<?php use Roots\Sage\Nav\NavWalker; ?>

<?php
global $query_string;
var_dump($query_string);
$site = Timber::get_context();
Timber::render('header.twig', $site);
