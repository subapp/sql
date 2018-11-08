<?php

namespace Subapp\Sql\Render\MySQL\Sqlizer;

use Subapp\Sql\Ast\Collection;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Render\AbstractSqlizer;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class Where
 * @package Subapp\Sql\Render\MySQL\Sqlizer
 */
class Where extends AbstractSqlizer
{
    
    /**
     * @param ExpressionInterface|Collection $expression
     * @param RendererInterface   $renderer
     * @return string
     */
    public function getSql(ExpressionInterface $expression, RendererInterface $renderer)
    {
        return $expression->isNotEmpty() ? sprintf('WHERE %s', $renderer->render($expression)) : null;
    }
    
}