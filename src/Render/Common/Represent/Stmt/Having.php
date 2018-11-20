<?php

namespace Subapp\Sql\Render\Common\Represent\Stmt;

use Subapp\Sql\Ast\ExpressionInterface;
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
     * @param ExpressionInterface|HavingExpression $expression
     * @param RendererInterface $renderer
     * @return string
     */
    public function getSql(ExpressionInterface $expression, RendererInterface $renderer)
    {
        return $expression->isNotEmpty() ? sprintf(' HAVING %s', parent::getSql($expression, $renderer)) : null;
    }

}