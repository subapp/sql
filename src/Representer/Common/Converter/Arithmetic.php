<?php

namespace Subapp\Sql\Representer\Common\Converter;

use Subapp\Sql\Ast\Arithmetic as ArithmeticExpression;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Representer\RepresenterInterface;

/**
 * Class Arithmetic
 * @package Subapp\Sql\Representer\Common\Converter
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