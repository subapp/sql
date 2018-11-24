<?php

namespace Subapp\Sql\Converter\Common;

use Subapp\Sql\Ast\Arithmetic as ArithmeticNode;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class Arithmetic
 * @package Subapp\Sql\Converter\Common
 */
class Arithmetic extends Collection
{
    
    /**
     * @param NodeInterface|ArithmeticNode $collection
     * @param ProviderInterface            $provider
     * @return string
     */
    public function toSql(NodeInterface $collection, ProviderInterface $provider)
    {
        return sprintf($collection->isBraced() ? '(%s)' : '%s', parent::toSql($collection, $provider));
    }
    
    /**
     * @inheritDoc
     */
    public function toNode(array $ast, ProviderInterface $provider)
    {
        return $this->toCollection(new ArithmeticNode(), $ast, $provider);
    }
    
    /**
     * @inheritDoc
     */
    public function getName()
    {
        return self::CONVERTER_ARITHMETIC;
    }
    
}