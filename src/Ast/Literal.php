<?php

namespace Subapp\Sql\Ast;

/**
 * Class Literal
 * @package Subapp\Sql\Ast
 */
class Literal extends AbstractExpression
{

    public const STRING  = 1;
    public const BOOLEAN = 2;
    public const INT = 3;
    public const FLOAT = 4;
    public const NULL = 5;

    /**
     * @var string|integer|float|boolean
     */
    private $value;

    /**
     * @var integer
     */
    private $type = Literal::STRING;

    /**
     * Literal constructor.
     * @param bool|float|int|string $value
     * @param int $type
     */
    public function __construct($value, $type = Literal::STRING)
    {
        $this->value = $value;
        $this->type = $type;
    }

    /**
     * @return boolean|float|integer|string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param boolean|float|integer|string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return integer
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param integer $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getSqlizerName()
    {
        return 'sqlizer.literal';
    }

}