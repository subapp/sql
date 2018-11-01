<?php

namespace Subapp\Sql\Represent\MySQL\Sqlizer;

use Subapp\Sql\Ast\Embrace as EmbraceExpression;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Represent\AbstractSqlizer;
use Subapp\Sql\Represent\RendererInterface;

/**
 * Class Embrace
 * @package Subapp\Sql\Represent\MySQL\Sqlizer
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