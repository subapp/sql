<?php

namespace Subapp\Sql\Represent\MySQL\Sqlizer;

use Subapp\Sql\Ast\ExpressionInterface;
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
     * @param ExpressionInterface|\Subapp\Sql\Ast\From $expression
     * @return string
     */
    public function getSql(RendererInterface $renderer, ExpressionInterface $expression)
    {
        return sprintf('FROM `%s`', $expression->getTable());
    }
    
}