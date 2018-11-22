<?php

namespace Subapp\Sql\Converter;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Common\ClassNameTrait;

/**
 * Class AbstractRepresent
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
    public function toArray(NodeInterface $node, RepresenterInterface $renderer)
    {
        return ['nodeName' => $node->getNodeName(),];
    }

    /**
     * @inheritDoc
     */
    public function toNode(array $ast, RepresenterInterface $renderer)
    {
        // TODO: Implement fromArray() method.
    }

}