<?php

namespace Subapp\Sql\Converter\Common\Stmt;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Stmt\Having as HavingNode;
use Subapp\Sql\Converter\Common\Condition\Conditions;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class Having
 * @package Subapp\Sql\Converter\Common\Stmt
 */
class Having extends Conditions
{
    
    /**
     * @param NodeInterface|HavingNode $node
     * @param ProviderInterface        $provider
     * @return string
     */
    public function toSql(NodeInterface $node, ProviderInterface $provider)
    {
        return $node->isNotEmpty() ? sprintf(' HAVING %s', parent::toSql($node, $provider)) : null;
    }
    
    /**
     * @inheritDoc
     */
    public function toNode(array $ast, ProviderInterface $provider)
    {
        return $this->toCollection(new HavingNode(), $ast, $provider);
    }
    
    /**
     * @inheritDoc
     */
    public function getName()
    {
        return self::CONVERTER_STMT_HAVING;
    }
    
}