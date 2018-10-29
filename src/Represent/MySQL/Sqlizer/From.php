<?php

namespace Subapp\Sql\Represent\MySQL\Sqlizer;

use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\From as FromExpression;
use Subapp\Sql\Represent\AbstractSqlizer;
use Subapp\Sql\Represent\RendererInterface;

/**
 * Class From
 * @package Subapp\Sql\Represent\MySQL\Sqlizer
 */
class From extends AbstractSqlizer
{
    
    /**
     * @param RendererInterface   $renderer
     * @param ExpressionInterface|FromExpression $expression
     * @return string
     */
    public function getSql(ExpressionInterface $expression, RendererInterface $renderer)
    {
        return sprintf('FROM `%s`', $expression->getTable());
    }
    
}