<?php

namespace Subapp\Sql\Ast;

/**
 * Class Arithmetic
 * @package Subapp\Sql\Ast
 */
class Arithmetic extends AbstractExpression
{
    
    const MINUS    = '+';
    const PLUS     = '+';
    const MULTIPLY = '*';
    const DIVIDE   = '/';
    
    /**
     * @var ExpressionInterface
     */
    private $operandA;
    
    /**
     * @var string
     */
    private $operator;
    
    /**
     * @var ExpressionInterface
     */
    private $operandB;
    
    /**
     * Arithmetic constructor.
     * @param ExpressionInterface $operandA
     * @param string              $operator
     * @param ExpressionInterface $operandB
     */
    public function __construct(
        ExpressionInterface $operandA = null, $operator = self::PLUS, ExpressionInterface $operandB = null)
    {
        $this->operandA = $operandA;
        $this->operator = $operator;
        $this->operandB = $operandB;
    }
    
    /**
     * @return ExpressionInterface
     */
    public function getOperandA()
    {
        return $this->operandA;
    }
    
    /**
     * @param ExpressionInterface $operandA
     */
    public function setOperandA(ExpressionInterface $operandA)
    {
        $this->operandA = $operandA;
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
     * @return ExpressionInterface
     */
    public function getOperandB()
    {
        return $this->operandB;
    }
    
    /**
     * @param ExpressionInterface $operandB
     */
    public function setOperandB(ExpressionInterface $operandB)
    {
        $this->operandB = $operandB;
    }
    
    /**
     * @return string
     */
    public function getSqlizerName()
    {
        return 'sqlizer.arithmetic';
    }
}