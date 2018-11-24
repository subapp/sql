<?php

namespace Subapp\Sql\Converter\Common;

use Subapp\Sql\Ast\MathOperator as MathOperatorNode;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class MathOperator
 * @package Subapp\Sql\Converter\Common
 */
class MathOperator extends AbstractConverter
{
    
    /**
     * @param NodeInterface|MathOperatorNode $node
     * @param ProviderInterface              $provider
     * @return string
     */
    public function toSql(NodeInterface $node, ProviderInterface $provider)
    {
        return $node->getOperator();
    }
    
    /**
     * @inheritDoc
     *
     * @param NodeInterface|MathOperatorNode $node
     */
    public function toArray(NodeInterface $node, ProviderInterface $provider)
    {
        $values = parent::toArray($node, $provider);
        
        $values['value'] = $node->getOperator();
        
        return $values;
    }
    
    /**
     * @inheritDoc
     */
    public function toNode(array $ast, ProviderInterface $provider)
    {
        return new MathOperatorNode($ast['value']);
    }
    
    /**
     * @inheritDoc
     */
    public function getName()
    {
        return self::CONVERTER_MATH_OPERATOR;
    }
    
}