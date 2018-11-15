<?php

namespace Subapp\Sql\Ast\Condition\Term;

use Subapp\Sql\Ast\Condition\LogicOperator;
use Subapp\Sql\Ast\Condition\Condition;
use Subapp\Sql\Ast\ExpressionInterface;

/**
 * Class ORTerm
 * @package Subapp\Sql\Ast\Condition\Term
 */
class ORCondition extends Condition
{
    
    /**
     * ORTerm constructor.
     *
     * @param ExpressionInterface $expression
     */
    public function __construct(ExpressionInterface $expression)
    {
        parent::__construct(new LogicOperator(LogicOperator::OR), $expression);
    }
    
}