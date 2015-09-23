<?php
namespace Werkint\Bundle\QueryBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Werkint\Bundle\QueryBundle\DependencyInjection\Compiler\QueryHandlerPass;
use Werkint\Bundle\QueryBundle\DependencyInjection\Compiler\ServiceConfigPass;

/**
 * WerkintQueryBundle.
 */
class WerkintQueryBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new ServiceConfigPass());
        $container->addCompilerPass(new QueryHandlerPass());
    }
}
