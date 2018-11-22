<?php

namespace Subapp\Sql\Converter\Common;

use Subapp\Sql\Ast\Arithmetic as ArithmeticExpression;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Converter\RepresenterInterface;

/**
 * Class Arithmetic
 * @package Subapp\Sql\Converter\Common
 */
class Arithmetic extends Collection
{
    
    /**
     * @param NodeInterface|ArithmeticExpression $collection
     * @param RepresenterInterface                        $renderer
     * @return string
     */
    public function toSql(NodeInterface $collection, RepresenterInterface $renderer)
    {
        return sprintf($collection->isBraced() ? '(%s)' : '%s', parent::toSql($collection, $renderer));
    }
    
}