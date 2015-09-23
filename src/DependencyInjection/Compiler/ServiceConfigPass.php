<?php
namespace Werkint\Bundle\QueryBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * ServiceConfigPass.
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
class ServiceConfigPass implements
    CompilerPassInterface
{
    const PAGINATOR_LISTENER = 'werkint_query.event_listener.pageableresultlistener';
    const PAGINATOR_SERVICE = 'knp_paginator';

    /**
     * @inheritdoc
     */
    public function process(
        ContainerBuilder $container
    ) {
        if (!$container->hasDefinition(static::PAGINATOR_SERVICE)) {
            $container->removeDefinition(static::PAGINATOR_LISTENER);
        }
    }

}
