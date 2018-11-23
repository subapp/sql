<?php

namespace Subapp\Sql\Converter\Common;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Parameter as ParameterExpression;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class Parameter
 * @package Subapp\Sql\Converter\Common
 */
class Parameter extends AbstractConverter
{
    
    /**
     * @param NodeInterface|ParameterExpression $node
     * @param ProviderInterface                       $renderer
     * @return string
     */
    public function toSql(NodeInterface $node, ProviderInterface $renderer)
    {
        $parameter = sprintf('%s', $node->getType());
        
        if ($node->isNamed()) {
            $parameter = sprintf('%s%s', $parameter, $node->getName());
        }
        
        return $parameter;
    }

    /**
     * @inheritDoc
     *
     * @param NodeInterface|ParameterExpression $node
     */
    public function toArray(NodeInterface $node, ProviderInterface $renderer)
    {
        return ['name' => $node->getName(), 'type' => $node->getType(),];
    }

    /**
     * @inheritDoc
     */
    public function toNode(array $ast, ProviderInterface $renderer)
    {
        // TODO: Implement fromArray() method.
    }

}