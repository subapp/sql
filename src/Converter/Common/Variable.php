<?php

namespace Subapp\Sql\Converter\Common;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Variable as VariableNode;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class Variable
 * @package Subapp\Sql\Converter\Common
 */
class Variable extends AbstractConverter
{
    
    /**
     * @param NodeInterface|VariableNode $node
     * @param ProviderInterface          $provider
     * @return string
     */
    public function toSql(NodeInterface $node, ProviderInterface $provider)
    {
        return sprintf('%s%s',
            $provider->toSql($node->getExpression()),
            ($node->getAlias() ? sprintf(' AS %s', $provider->toSql($node->getAlias())) : null)
        );
    }
    
    /**
     * @inheritDoc
     *
     * @param NodeInterface|VariableNode $node
     */
    public function toArray(NodeInterface $node, ProviderInterface $provider)
    {
        $values = parent::toArray($node, $provider);
        
        $values['expression'] = $provider->toArray($node->getExpression());
        $values['alias'] = $node->getAlias()
            ? $provider->toArray($node->getAlias()) : null;
        
        return $values;
    }
    
    /**
     * @inheritDoc
     */
    public function toNode(array $ast, ProviderInterface $provider)
    {
        return new VariableNode(
            $provider->toNode($ast['expression']),
            $ast['alias'] ? $provider->toNode($ast['alias']) : null);
    }
    
    /**
     * @inheritDoc
     */
    public function getName()
    {
        return self::CONVERTER_VARIABLE;
    }
    
}