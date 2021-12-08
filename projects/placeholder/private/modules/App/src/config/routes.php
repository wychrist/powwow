<?php

/*-------------------------------------------------------
 * Routes for App Module
 * 
 * In this file, you  have access to an instance of the 
 * route builder via the variable $builder
 * -----------------------------------------------------*/

 $builder = $event->getBuilder(); // from App\Listener::onRouteSetup

 $builder->onGet(config()->get('app.default_index_page'), 'App\Controller\IndexController::indexAction', 'index');

 // Dynamic pages handler
 $builder->onGet('/pages/{id}', 'App\Controller\PageController::indexAction', 'app_page');

 // Posts handler
 $builder->onGet('/posts/{id}', 'App\Controller\PostController::indexAction', 'app_post');

 // Contact us
 $builder->onGet('/contact-us','App\Controller\ContactController::indexAction', 'contactus_form');
 $builder->onGet('/contact-us/submit','App\Controller\ContactController::handleFormAction', 'contactus_form_handler');
