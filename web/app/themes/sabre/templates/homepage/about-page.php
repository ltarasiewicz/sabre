<?php
$context = Timber::get_context();
$context['page'] = new TimberPost(get_page_by_title('About'));
Timber::render('homepage/about-page.twig', $context);