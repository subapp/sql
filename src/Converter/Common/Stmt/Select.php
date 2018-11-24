<?php

namespace Subapp\Sql\Converter\Common\Stmt;

use Subapp\Sql\Ast\Literal;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Stmt\Select as SelectNode;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class Select
 * @package Subapp\Sql\Converter\Common\Stmt
 */
class Select extends AbstractConverter
{
    
    /**
     * @param ProviderInterface        $provider
     * @param NodeInterface|SelectNode $node
     * @return string
     */
    public function toSql(NodeInterface $node, ProviderInterface $provider)
    {
        return sprintf("SELECT %s%s%s%s%s%s%s%s",
            $provider->toSql($node->getArguments()),
            $provider->toSql($node->getFrom()),
            $provider->toSql($node->getJoins()),
            $provider->toSql($node->getWhere()),
            $provider->toSql($node->getGroupBy()),
            $provider->toSql($node->getHaving()),
            $provider->toSql($node->getOrderBy()),
            $provider->toSql($node->getLimit()),
            $node->isSemicolon() ? "\n;" : null
        );
    }
    
    /**
     * @inheritDoc
     *
     * @param NodeInterface|SelectNode $node
     */
    public function toArray(NodeInterface $node, ProviderInterface $provider)
    {
        $values = parent::toArray($node, $provider);
        
        $values['arguments'] = $provider->toArray($node->getArguments());
        $values['from'] = $provider->toArray($node->getFrom());
        $values['joins'] = $provider->toArray($node->getJoins());
        $values['where'] = $provider->toArray($node->getWhere());
        $values['groupBy'] = $provider->toArray($node->getGroupBy());
        $values['having'] = $provider->toArray($node->getHaving());
        $values['orderBy'] = $provider->toArray($node->getOrderBy());
        $values['limit'] = $provider->toArray($node->getLimit());
        $values['semicolon'] = $provider->toArray(new Literal($node->isSemicolon(), Literal::BOOLEAN));
        
        return $values;
    }
    
    /**
     * @inheritDoc
     */
    public function toNode(array $ast, ProviderInterface $provider)
    {
        $select = new SelectNode();
        
        $select->setArguments($provider->toNode($ast['arguments']));
        $select->setFrom($provider->toNode($ast['from']));
        $select->setJoins($provider->toNode($ast['joins']));
        $select->setWhere($provider->toNode($ast['where']));
        $select->setGroupBy($provider->toNode($ast['groupBy']));
        $select->setHaving($provider->toNode($ast['having']));
        $select->setOrderBy($provider->toNode($ast['orderBy']));
        $select->setLimit($provider->toNode($ast['limit']));
        
        $select->setSemicolon($ast['semicolon']['value']);
        
        return $select;
    }
    
    /**
     * @inheritDoc
     */
    public function getName()
    {
        return self::CONVERTER_STMT_SELECT;
    }
    
}