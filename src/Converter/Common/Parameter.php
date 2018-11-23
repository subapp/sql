<?php

namespace Subapp\Sql\Converter\Common;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Parameter as ParameterNode;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class Parameter
 * @package Subapp\Sql\Converter\Common
 */
class Parameter extends AbstractConverter
{
    
    /**
     * @param NodeInterface|ParameterNode $node
     * @param ProviderInterface                       $provider
     * @return string
     */
    public function toSql(NodeInterface $node, ProviderInterface $provider)
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
     * @param NodeInterface|ParameterNode $node
     */
    public function toArray(NodeInterface $node, ProviderInterface $provider)
    {
        $values = parent::toArray($node, $provider);

        $values['name'] = $node->getName();
        $values['type'] = $node->getType();

        return $values;
    }

    /**
     * @inheritDoc
     */
    public function toNode(array $ast, ProviderInterface $provider)
    {
        return new ParameterNode($ast['type'], $ast['name']);
    }

}