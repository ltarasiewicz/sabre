<?php

$context = Timber::get_context();
$context['brands'] = Timber::get_posts(array('post_type' => 'brand'));
Timber::render('homepage/brands-strap.twig', $context);