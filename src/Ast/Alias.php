<?php

namespace Subapp\Sql\Ast;

/**
 * Class Alias
 * @package Subapp\Sql\Ast
 */
class Alias extends AbstractExpression
{

    /**
     * @var ExpressionInterface
     */
    private $alias;

    /**
     * @var ExpressionInterface
     */
    private $expression;

    /**
     * Alias constructor.
     *
     * @param ExpressionInterface $expression
     * @param ExpressionInterface $alias
     */
    public function __construct(ExpressionInterface $expression = null, ExpressionInterface $alias = null)
    {
        $this->expression = $expression;
        $this->alias = $alias;
    }

    /**
     * @return ExpressionInterface
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @param ExpressionInterface $alias
     */
    public function setAlias(ExpressionInterface $alias)
    {
        $this->alias = $alias;
    }

    /**
     * @return ExpressionInterface
     */
    public function getExpression()
    {
        return $this->expression;
    }

    /**
     * @param ExpressionInterface $expression
     */
    public function setExpression(ExpressionInterface $expression)
    {
        $this->expression = $expression;
    }

    /**
     * @return string
     */
    public function getSqlizerName()
    {
        return 'sqlizer.alias';
    }

}