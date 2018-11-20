<?php

namespace Subapp\Sql\Ast;

/**
 * Class MathOperator
 * @package Subapp\Sql\Ast
 */
class MathOperator extends AbstractExpression
{
    
    const NONE     = null;
    const MINUS    = '-';
    const PLUS     = '+';
    const MULTIPLY = '*';
    const DIVIDE   = '/';
    
    /**
     * @var string
     */
    private $operator;
    
    /**
     * MathOperator constructor.
     * @param null|string $operator
     */
    public function __construct($operator = self::NONE)
    {
        $this->operator = $operator;
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
    public function setOperator(string $operator)
    {
        $this->operator = $operator;
    }
    
    /**
     * @return string
     */
    public function getRenderer()
    {
        return 'represent.math_operator';
    }
    
}