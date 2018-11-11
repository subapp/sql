<?php

namespace Subapp\Sql\Ast\Condition\Term;

use Subapp\Sql\Ast\Condition\LogicOperator;
use Subapp\Sql\Ast\Condition\Term;
use Subapp\Sql\Ast\ExpressionInterface;

/**
 * Class ORTerm
 * @package Subapp\Sql\Ast\Condition\Term
 */
class ORTerm extends Term
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