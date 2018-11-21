<?php

namespace Subapp\Sql\Render\Common\Represent\Condition;

use Subapp\Sql\Ast\Condition\Conditions as ConditionsExpression;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Render\Common\Represent\Collection;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class Conditions
 * @package Subapp\Sql\Render\Common\Represent\Condition
 */
class Conditions extends Collection
{
    
    /**
     * @param NodeInterface|ConditionsExpression $collection
     * @param RendererInterface                        $renderer
     * @return string
     */
    public function getSql(NodeInterface $collection, RendererInterface $renderer)
    {
        $operator = $renderer->render($collection->getOperator());
        
        $collection->setSeparator(sprintf("\x20%s\x20", $operator));
        
        return sprintf($collection->isBraced() ? '(%s)' : '%s', parent::getSql($collection, $renderer));
    }
    
}