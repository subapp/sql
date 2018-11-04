<?php

namespace Subapp\Sql\Render\Common\Sqlizer;

use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\Func\SimpleFunc;
use Subapp\Sql\Render\AbstractSqlizer;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class SimpleFunction
 * @package Subapp\Sql\Render\Common\Sqlizer
 */
class SimpleFunction extends AbstractSqlizer
{
    
    /**
     * @param ExpressionInterface|SimpleFunc $expression
     * @param RendererInterface   $renderer
     * @return string
     */
    public function getSql(ExpressionInterface $expression, RendererInterface $renderer)
    {
        return sprintf('%s(%s)', strtoupper($renderer->render($expression->getFunctionName())),
            $renderer->render($expression->getArguments()));
    }
    
}