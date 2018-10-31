<?php

namespace Subapp\Sql\Ast;

/**
 * Class Arithmetic
 * @package Subapp\Sql\Ast
 */
class Operand extends AbstractExpression
{

    const NONE     = null;
    const MINUS    = '-';
    const PLUS     = '+';
    const MULTIPLY = '*';
    const DIVIDE   = '/';
    
    /**
     * @var ExpressionInterface
     */
    private $expression;
    
    /**
     * @var string
     */
    private $operator;
    
    /**
     * Arithmetic constructor.
     * @param ExpressionInterface $expression
     * @param string              $operator
     */
    public function __construct($operator = self::NONE, ExpressionInterface $expression = null)
    {
        $this->operator = $operator;
        $this->expression = $expression;
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
    public function getOperator()
    {
        return $this->operator;
    }
    
    /**
     * @param string $operator
     */
    public function setOperator($operator)
    {
        $this->operator = $operator;
    }

    /**
     * @return string
     */
    public function getSqlizerName()
    {
        return 'sqlizer.operand';
    }
}