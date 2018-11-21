<?php

namespace Subapp\Sql\Representer\Common\Converter\Stmt;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Stmt\Having as HavingExpression;
use Subapp\Sql\Representer\Common\Converter\Condition\Conditions;
use Subapp\Sql\Representer\RepresenterInterface;

/**
 * Class Having
 * @package Subapp\Sql\Representer\Common\Converter\Stmt
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