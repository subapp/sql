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
     * @inheritDoc
     */
    public function toArray(NodeInterface $node, ProviderInterface $provider)
    {
        // converter key-name
        return ['node' => $this->getName(),];
    }
    
}