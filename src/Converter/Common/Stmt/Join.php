<?php

namespace Subapp\Sql\Converter\Common\Stmt;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Stmt\Join as JoinNode;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class Join
 * @package Subapp\Sql\Converter\Common\Stmt
 */
class Join extends AbstractConverter
{
    
    /**
     * @param NodeInterface|JoinNode $node
     * @param ProviderInterface      $provider
     * @return string
     */
    public function toSql(NodeInterface $node, ProviderInterface $provider)
    {
        return sprintf('%s JOIN %s %s (%s)',
            $node->getJoinType(),
            $provider->toSql($node->getLeft()),
            $node->getConditionType(),
            $provider->toSql($node->getCondition())
        );
    }
    
    /**
     * @inheritDoc
     *
     * @param NodeInterface|JoinNode $node
     */
    public function toArray(NodeInterface $node, ProviderInterface $provider)
    {
        $values = parent::toArray($node, $provider);
        
        $values['type'] = $node->getJoinType();
        $values['conditionType'] = $node->getConditionType();
        $values['left'] = $provider->toArray($node->getLeft());
        $values['condition'] = $provider->toArray($node->getCondition());
        
        return $values;
    }
    
    /**
     * @inheritDoc
     */
    public function toNode(array $ast, ProviderInterface $provider)
    {
        $join = new JoinNode($ast['type']);
        
        $join->setCondition($provider->toNode($ast['condition']));
        $join->setConditionType($ast['conditionType']);
        $join->setLeft($provider->toNode($ast['left']));
        
        return $join;
    }
    
    /**
     * @inheritDoc
     */
    public function getName()
    {
        return self::CONVERTER_STMT_JOIN;
    }
    
}