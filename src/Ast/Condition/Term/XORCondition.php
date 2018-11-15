<?php

namespace Subapp\Sql\Ast\Condition\Term;

use Subapp\Sql\Ast\Condition\LogicOperator;
use Subapp\Sql\Ast\Condition\Condition;
use Subapp\Sql\Ast\ExpressionInterface;

/**
 * Class XORTerm
 * @package Subapp\Sql\Ast\Condition\Term
 */
class XORCondition extends Condition
{
    
    /**
     * XORTerm constructor.
     *
     * @param ExpressionInterface $expression
     */
    public function __construct(ExpressionInterface $expression)
    {
        parent::__construct(new LogicOperator(LogicOperator::XOR), $expression);
    }
    
}