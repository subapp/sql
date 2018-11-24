<?php

namespace Subapp\Sql\Converter\Common\Stmt;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Stmt\Where as WhereNode;
use Subapp\Sql\Converter\Common\Condition\Conditions;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class Where
 * @package Subapp\Sql\Converter\Common\Stmt
 */
class Where extends Conditions
{
    
    /**
     * @param NodeInterface|WhereNode $node
     * @param ProviderInterface       $provider
     * @return string
     */
    public function toSql(NodeInterface $node, ProviderInterface $provider)
    {
        return $node->isNotEmpty() ? sprintf(' WHERE %s', parent::toSql($node, $provider)) : null;
    }
    
    /**
     * @inheritDoc
     */
    public function toNode(array $ast, ProviderInterface $provider)
    {
        return $this->toCollection(new WhereNode(), $ast, $provider);
    }
    
    /**
     * @inheritDoc
     */
    public function getName()
    {
        return self::CONVERTER_STMT_WHERE;
    }
    
}