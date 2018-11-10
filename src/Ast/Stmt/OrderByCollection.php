<?php

namespace Subapp\Sql\Ast\Stmt;

use Subapp\Sql\Ast\Arguments;

/**
 * Class OrderByCollection
 * @package Subapp\Sql\Ast\Stmt
 */
class OrderByCollection extends Arguments
{
    
    /**
     * TermCollection constructor.
     * @param array $expressions
     */
    public function __construct($expressions = [])
    {
        parent::__construct($expressions);
        
        $this->setClassName(OrderBy::class);
    }
    
}