<?php

namespace Subapp\Sql\Ast\Condition\Term;

use Subapp\Sql\Ast\Condition\Term;

/**
 * Class XorTerm
 * @package Subapp\Sql\Ast\Condition\Term
 */
class XorTerm extends Term
{
    
    /**
     * AndTerm constructor.
     */
    public function __construct()
    {
        parent::__construct(Term::XOR);
    }
    
}