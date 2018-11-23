<?php

namespace Subapp\Sql\Converter\Common;

use Subapp\Sql\Ast\Arithmetic as ArithmeticExpression;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class Arithmetic
 * @package Subapp\Sql\Converter\Common
 */
class Arithmetic extends Collection
{
    
    /**
     * @param NodeInterface|ArithmeticExpression $collection
     * @param ProviderInterface                        $renderer
     * @return string
     */
    public function toSql(NodeInterface $collection, ProviderInterface $renderer)
    {
        return sprintf($collection->isBraced() ? '(%s)' : '%s', parent::toSql($collection, $renderer));
    }
    
}