<?php

namespace Subapp\Sql\Ast\Stmt;

use Subapp\Sql\Ast\Arguments;

/**
 * Class OrderByCollection
 * @package Subapp\Sql\Ast\Stmt
 */
class OrderByItems extends Arguments
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
    
    /**
     * @return string
     */
    public function getRendererName()
    {
        return 'stmt.order_by_items';
    }
    
}