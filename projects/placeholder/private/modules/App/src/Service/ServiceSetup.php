<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Service;

use App\Service\Face\Data\Orm\EntityManagerFatoryInterface;

/**
 * Description of ServiceSetup
 *
 * @author unleash
 */
class ServiceSetup
{

    public function setup(\Fluid\Events\InjectService $Event)
    {
        // Menu service
        $Event->injector()->alias(Face\MenuInterface::class, Menu::class);

        // Breadcrumb service
        $Event->injector()->alias(Face\BreadcrumbInterface::class, Breadcrumb::class);

        // UI service
        $Event->injector()->alias(Face\UiServiceInterface::class, UiService::class);
        $Event->injector()->share(Face\UiServiceInterface::class);
        
        // orm
        $Event->injector()->alias(EntityManagerFatoryInterface::class, EntityManagerFactory::class);
    }

}
