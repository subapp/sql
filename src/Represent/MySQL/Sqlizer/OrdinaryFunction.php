<?php

namespace Subapp\Sql\Represent\MySQL\Sqlizer;

use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\Func\Ordinary;
use Subapp\Sql\Represent\AbstractSqlizer;
use Subapp\Sql\Represent\RendererInterface;

/**
 * Class OrdinaryFunction
 * @package Subapp\Sql\Represent\MySQL\Sqlizer
 */
class OrdinaryFunction extends AbstractSqlizer
{
    
    /**
     * @param ExpressionInterface|Ordinary $expression
     * @param RendererInterface   $renderer
     * @return string
     */
    public function getSql(ExpressionInterface $expression, RendererInterface $renderer)
    {
        return sprintf('%s(%s)', strtoupper($renderer->render($expression->getFunctionName())),
            $renderer->render($expression->getVariables()));
    }
    
}