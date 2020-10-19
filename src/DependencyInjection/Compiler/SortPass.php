<?php


namespace App\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class SortPass implements CompilerPassInterface
{
    const CRV_SORTING = 'crv.sorting';  #connected to: services.yaml, App\DataHandling\SimpleSortRegistry
    const CRV_SORTER = 'crv.sorter';    #connected to: services.yaml, App\Sorter\

    public function process(ContainerBuilder $container)
    {
        // check if the sorter service is even defined
        // and if not, exit early
        if ( ! $container->has(self::CRV_SORTING)) {
            return false;
        }

        $definition = $container->findDefinition(self::CRV_SORTING);

        // find all the services that are tagged as sorter
        $taggedServices = $container->findTaggedServiceIds(self::CRV_SORTER);
        foreach ($taggedServices as $id => $tag) {
            // add the service to the Sorter array
            $definition->addMethodCall(
                'addSorter',
                [
                    new Reference($id)
                ]
            );
        }
    }
}

