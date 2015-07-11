<?php
$currentPage = get_the_ID();

$context['page'] = Timber::get_post($currentPage, 'SabrePost');

$context['educators'] = Timber::get_posts(array(
    'post_type' => 'educator',
    'posts_per_page' => -1,

), 'SabrePost');

//$context['joico_artists'] = Timber::get_posts(array(
//    'post_type' => 'educator',
//    'posts_per_page' => -1,
//    'category_name' => 'joico'
//), 'SabrePost');

Timber::render('page-education.twig', $context);