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
        return sprintf('(%s)', parent::getSql($collection, $renderer));
    }
    
}