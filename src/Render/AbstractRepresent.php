<?php

namespace Subapp\Sql\Render;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Common\ClassNameTrait;

/**
 * Class AbstractRepresent
 * @package Subapp\Sql\Render
 */
abstract class AbstractRepresent implements RepresentInterface
{
    
    use ClassNameTrait;
    
    /**
     * @return string
     */
    public function getName()
    {
        return $this->getUnderscore(static::class);
    }

    /**
     * @inheritDoc
     */
    public function toArray(NodeInterface $node, RendererInterface $renderer)
    {
        return ['nodeName' => $node->getNodeName(),];
    }

    /**
     * @inheritDoc
     */
    public function toNode(array $values, RendererInterface $renderer)
    {
        // TODO: Implement fromArray() method.
    }

}