<?php

namespace Subapp\Sql\Render\Common\Represent;

use Subapp\Sql\Ast\Arithmetic as ArithmeticExpression;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class Arithmetic
 * @package Subapp\Sql\Render\Common\Represent
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
        return sprintf($collection->isBraced() ? '(%s)' : '%s', parent::getSql($collection, $renderer));
    }
    
}