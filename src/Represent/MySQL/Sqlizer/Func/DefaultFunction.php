<?php

namespace Subapp\Sql\Represent\MySQL\Sqlizer\Func;

use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\Func\DefaultFunction as DefaultFunctionExpression;
use Subapp\Sql\Represent\AbstractSqlizer;
use Subapp\Sql\Represent\RendererInterface;

/**
 * Class DefaultFunction
 * @package Subapp\Sql\Represent\MySQL\Sqlizer\Func
 */
class DefaultFunction extends AbstractSqlizer
{
    
    /**
     * @param ExpressionInterface|DefaultFunctionExpression $expression
     * @param RendererInterface   $renderer
     * @return string
     */
    public function getSql(ExpressionInterface $expression, RendererInterface $renderer)
    {
        return sprintf('%s(%s)', strtoupper($renderer->render($expression->getFunctionName())),
            $renderer->render($expression->getArguments()));
    }
    
}