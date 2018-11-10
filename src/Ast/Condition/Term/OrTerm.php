<?php

namespace Subapp\Sql\Ast\Condition\Term;

use Subapp\Sql\Ast\Condition\Term;

/**
 * Class OrTerm
 * @package Subapp\Sql\Ast\Condition\Term
 */
class OrTerm extends Term
{
    
    /**
     * AndTerm constructor.
     */
    public function __construct()
    {
        parent::__construct(Term::OR);
    }
    
}