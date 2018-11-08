<?php

namespace Subapp\Sql\Ast;

/**
 * Class LogicOperator
 * @package Subapp\Sql\Ast
 */
class LogicOperator extends AbstractExpression
{

    const AND = 'AND';
    const OR = 'OR';
    const XOR = 'XOR';
    const IS = 'IS';
    const NOT = 'NOT';

    /**
     * @var string
     */
    private $operator;

    /**
     * LogicOperator constructor.
     * @param string $operator
     */
    public function __construct($operator = self::AND)
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
    public function setOperator($operator)
    {
        $this->operator = $operator;
    }

    /**
     * @inheritdoc
    */
    public function getSqlizerName()
    {
        return 'sqlizer.logic_operator';
    }

}