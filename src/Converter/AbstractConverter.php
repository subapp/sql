<?php

namespace Subapp\Sql\Converter;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Common\ClassNameTrait;

/**
 * Class AbstractConverter
 * @package Subapp\Sql\Converter
 */
abstract class AbstractConverter implements ConverterInterface
{
    
    use ClassNameTrait;
    
    /**
     * @return string
     */
    public function getName()
    {
        return $this->getObjectName(static::class, 'Converter');
    }

    /**
     * @inheritDoc
     */
    public function toArray(NodeInterface $node, ProviderInterface $provider)
    {
        return ['node' => $node->getNodeName(),];
    }

}