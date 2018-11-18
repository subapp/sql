<?php

namespace Subapp\Sql\Render\Common\Sqlizer\Condition;

use Subapp\Sql\Ast\Condition\Conditions as ConditionsExpression;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Render\Common\Sqlizer\Collection;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class Conditions
 * @package Subapp\Sql\Render\Common\Sqlizer\Condition
 */
class Conditions extends Collection
{
    
    /**
     * @param ExpressionInterface|ConditionsExpression $collection
     * @param RendererInterface                        $renderer
     * @return string
     */
    public function getSql(ExpressionInterface $collection, RendererInterface $renderer)
    {
        $operator = $renderer->render($collection->getOperator());
        
        $collection->setSeparator(sprintf("\x20%s\x20", $operator));
        
        return sprintf($collection->isBraced() ? '(%s)' : '%s', parent::getSql($collection, $renderer));
    }
    
}