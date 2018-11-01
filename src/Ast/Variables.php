<?php

namespace Subapp\Sql\Ast;

use Subapp\Collection\Collection;

/**
 * Class Arguments
 * @package Subapp\Sql\Ast
 */
class Variables extends AbstractExpression
{

    /**
     * @var Collection|ExpressionInterface[]
     */
    private $expressions;

    /**
     * Variables constructor.
     */
    public function __construct()
    {
        $this->expressions = new Collection([], ExpressionInterface::class);
    }

    /**
     * @param $index
     * @return ExpressionInterface|null
     */
    public function get($index)
    {
        return $this->expressions->offsetGet($index);
    }

    /**
     * @param $index
     */
    public function remove($index)
    {
        $this->expressions->remove($index);
    }

    /**
     * @param ExpressionInterface $expression
     */
    public function append(ExpressionInterface $expression)
    {
        $this->expressions->append($expression);
    }

    /**
     * @param ExpressionInterface $expression
     */
    public function prepend(ExpressionInterface $expression)
    {
        $this->expressions->prepend($expression);
    }

    /**
     * @return void
     */
    public function clear()
    {
        $this->expressions->clear();
    }
    
    /**
     * @return Collection|ExpressionInterface[]
     */
    public function getExpressions()
    {
        return $this->expressions;
    }

    /**
     * @return string
     */
    public function getSqlizerName()
    {
        return 'sqlizer.variables';
    }

}