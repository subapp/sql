<?php

namespace Subapp\Sql\Render\Common\Sqlizer\Func;

use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\Func\DefaultFunction as DefaultFunctionExpression;
use Subapp\Sql\Render\AbstractSqlizer;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class DefaultFunction
 * @package Subapp\Sql\Render\Common\Sqlizer\Func
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