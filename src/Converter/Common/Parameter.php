<?php

namespace Subapp\Sql\Converter\Common;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Parameter as ParameterExpression;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\RepresenterInterface;

/**
 * Class Parameter
 * @package Subapp\Sql\Converter\Common
 */
class Parameter extends AbstractConverter
{
    
    /**
     * @param NodeInterface|ParameterExpression $node
     * @param RepresenterInterface                       $renderer
     * @return string
     */
    public function toSql(NodeInterface $node, RepresenterInterface $renderer)
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
    public function toArray(NodeInterface $node, RepresenterInterface $renderer)
    {
        return ['name' => $node->getName(), 'type' => $node->getType(),];
    }

    /**
     * @inheritDoc
     */
    public function toNode(array $ast, RepresenterInterface $renderer)
    {
        // TODO: Implement fromArray() method.
    }

}