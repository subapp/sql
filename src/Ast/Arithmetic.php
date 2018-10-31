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
     * @var Operand[]|CollectionInterface
     */
    private $operands;

    public function __construct()
    {
        $this->operands = new Collection([], Operand::class);
    }

    /**
     * @param Operand $operand
     */
    public function addOperand(Operand $operand)
    {
        $this->operands->append($operand);
    }

    /**
     * @return CollectionInterface|Operand[]
     */
    public function getOperands()
    {
        return $this->operands;
    }

    /**
     * @return string
     */
    public function getSqlizerName()
    {
        return 'sqlizer.arithmetic';
    }

}