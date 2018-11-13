<?php

namespace Subapp\Sql\Render\Common\Sqlizer;

use Subapp\Sql\Ast\Arithmetic as ArithmeticExpression;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class Arithmetic
 * @package Subapp\Sql\Render\Common\Sqlizer
 */
class Arithmetic extends Collection
{
    
    /**
     * @param ExpressionInterface|ArithmeticExpression $collection
     * @param RendererInterface                        $renderer
     * @return string
     */
    public function getSql(ExpressionInterface $collection, RendererInterface $renderer)
    {
        return sprintf('(%s)', parent::getSql($collection, $renderer));
    }
    
}