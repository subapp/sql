<?php

namespace Subapp\Sql\Converter\Common\Condition;

use Subapp\Sql\Ast\Condition\Conditions as ConditionsNode;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Converter\Common\Collection;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class Conditions
 * @package Subapp\Sql\Converter\Common\Condition
 */
class Conditions extends Collection
{
    
    /**
     * @param NodeInterface|ConditionsNode $collection
     * @param ProviderInterface                        $provider
     * @return string
     */
    public function toSql(NodeInterface $collection, ProviderInterface $provider)
    {
        $operator = $provider->toSql($collection->getOperator());
        
        $collection->setSeparator(sprintf("\x20%s\x20", $operator));
        
        return sprintf($collection->isBraced() ? '(%s)' : '%s', parent::toSql($collection, $provider));
    }
    
}