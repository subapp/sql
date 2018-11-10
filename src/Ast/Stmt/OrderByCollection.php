<?php

namespace Subapp\Sql\Ast\Stmt;

use Subapp\Sql\Ast\Collection;

/**
 * Class OrderByCollection
 * @package Subapp\Sql\Ast\Stmt
 */
class OrderByCollection extends Collection
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