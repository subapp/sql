<?php

namespace Subapp\Sql\Render\Common\Represent\Stmt;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Stmt\Having as HavingExpression;
use Subapp\Sql\Render\Common\Represent\Condition\Conditions;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class Having
 * @package Subapp\Sql\Render\Common\Represent\Stmt
 */
class Having extends Conditions
{

    /**
     * @param NodeInterface|HavingExpression $node
     * @param RendererInterface $renderer
     * @return string
     */
    public function getSql(NodeInterface $node, RendererInterface $renderer)
    {
        return $node->isNotEmpty() ? sprintf(' HAVING %s', parent::getSql($node, $renderer)) : null;
    }

}