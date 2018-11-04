<?php

namespace Subapp\Sql\Ast;

use Subapp\Collection\Collection;
use Subapp\Collection\CollectionInterface;

/**
 * Class Arithmetic
 * @package Subapp\Sql\Ast
 */
class Arithmetic extends AbstractExpression
{

    /**
     * @var ExpressionInterface[]|CollectionInterface
     */
    private $collection;
    
    /**
     * Arithmetic constructor.
     */
    public function __construct()
    {
        $this->collection = new Collection([], ExpressionInterface::class);
    }

    /**
     * @param ExpressionInterface $expression
     */
    public function append(ExpressionInterface $expression)
    {
        $this->collection->append($expression);
    }

    /**
     * @param ExpressionInterface $expression
     */
    public function prepend(ExpressionInterface $expression)
    {
        $this->collection->prepend($expression);
    }

    /**
     * @return CollectionInterface|ExpressionInterface[]
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * @return string
     */
    public function getSqlizerName()
    {
        return 'sqlizer.arithmetic';
    }

}