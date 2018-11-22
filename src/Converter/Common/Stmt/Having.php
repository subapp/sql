<?php

namespace Subapp\Sql\Converter\Common\Stmt;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Stmt\Having as HavingExpression;
use Subapp\Sql\Converter\Common\Condition\Conditions;
use Subapp\Sql\Converter\RepresenterInterface;

/**
 * Class Having
 * @package Subapp\Sql\Converter\Common\Stmt
 */
class Having extends Conditions
{

    /**
     * @param NodeInterface|HavingExpression $node
     * @param RepresenterInterface $renderer
     * @return string
     */
    public function toSql(NodeInterface $node, RepresenterInterface $renderer)
    {
        return $node->isNotEmpty() ? sprintf(' HAVING %s', parent::toSql($node, $renderer)) : null;
    }

}