<?php

namespace Subapp\Sql\Render\MySQL\Sqlizer;

use Subapp\Sql\Ast\Embrace as EmbraceExpression;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Render\AbstractSqlizer;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class Embrace
 * @package Subapp\Sql\Render\MySQL\Sqlizer
 */
class Embrace extends AbstractSqlizer
{

    /**
     * @param ExpressionInterface|EmbraceExpression $expression
     * @param RendererInterface $renderer
     * @return string
     */
    public function getSql(ExpressionInterface $expression, RendererInterface $renderer)
    {
        return sprintf('(%s)', $renderer->render($expression->getInner()));
    }

}