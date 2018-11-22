<?php

namespace Subapp\Sql\Converter\Common\Condition;

use Subapp\Sql\Ast\Condition\Conditions as ConditionsExpression;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Converter\Common\Collection;
use Subapp\Sql\Converter\RepresenterInterface;

/**
 * Class Conditions
 * @package Subapp\Sql\Converter\Common\Condition
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