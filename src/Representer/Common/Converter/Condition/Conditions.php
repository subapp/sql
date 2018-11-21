<?php

namespace Subapp\Sql\Representer\Common\Converter\Condition;

use Subapp\Sql\Ast\Condition\Conditions as ConditionsExpression;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Representer\Common\Converter\Collection;
use Subapp\Sql\Representer\RepresenterInterface;

/**
 * Class Conditions
 * @package Subapp\Sql\Representer\Common\Converter\Condition
 */
class Conditions extends Collection
{
    
    /**
     * @param NodeInterface|ConditionsExpression $collection
     * @param RepresenterInterface                        $renderer
     * @return string
     */
    public function toSql(NodeInterface $collection, RepresenterInterface $renderer)
    {
        $operator = $renderer->toSql($collection->getOperator());
        
        $collection->setSeparator(sprintf("\x20%s\x20", $operator));
        
        return sprintf($collection->isBraced() ? '(%s)' : '%s', parent::toSql($collection, $renderer));
    }
    
}