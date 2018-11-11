<?php

namespace Subapp\Sql\Ast\Condition\Term;

use Subapp\Sql\Ast\Condition\LogicOperator;
use Subapp\Sql\Ast\Condition\Term;
use Subapp\Sql\Ast\ExpressionInterface;

/**
 * Class ANDTerm
 * @package Subapp\Sql\Ast\Condition\Term
 */
class ANDTerm extends Term
{
    
    /**
     * ANDTerm constructor.
     *
     * @param ExpressionInterface $expression
     */
    public function __construct(ExpressionInterface $expression)
    {
        parent::__construct(new LogicOperator(LogicOperator::AND), $expression);
    }
    
}