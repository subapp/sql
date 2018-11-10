<?php

namespace Subapp\Sql\Ast\Condition\Term;

use Subapp\Sql\Ast\Condition\Term;

/**
 * Class AndTerm
 * @package Subapp\Sql\Ast\Condition\Term
 */
class AndTerm extends Term
{
    
    /**
     * AndTerm constructor.
     */
    public function __construct()
    {
        parent::__construct(Term::AND);
    }
    
}