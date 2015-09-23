<?php
namespace Werkint\Bundle\QueryBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * QueryHandlerPass.
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
class QueryHandlerPass implements
    CompilerPassInterface
{
    const PROCESSOR_SERVICE = 'werkint_query.queryprocessor';
    const QUERY_HANDLER_TAG = 'werkint_query.queryhandler';

    /**
     * @inheritdoc
     */
    public function process(
        ContainerBuilder $container
    ) {
        if (!$container->hasDefinition(static::PROCESSOR_SERVICE)) {
            return;
        }
        $definition = $container->getDefinition(
            static::PROCESSOR_SERVICE
        );

        $list = $container->findTaggedServiceIds(static::QUERY_HANDLER_TAG);
        foreach ($list as $id => $attributes) {
            $definition->addMethodCall(
                'addHandler', [
                    new Reference($id),
                ]
            );
        }
    }

}
