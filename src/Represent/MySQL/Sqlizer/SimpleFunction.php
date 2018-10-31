<?php

namespace Subapp\Sql\Represent\MySQL\Sqlizer;

use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\Func\SimpleFunc;
use Subapp\Sql\Represent\AbstractSqlizer;
use Subapp\Sql\Represent\RendererInterface;

/**
 * Class SimpleFunction
 * @package Subapp\Sql\Represent\MySQL\Sqlizer
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