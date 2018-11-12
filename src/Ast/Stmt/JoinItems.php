<?php

namespace Subapp\Sql\Ast\Stmt;

use Subapp\Sql\Ast\Collection;

/**
 * Class JoinItems
 * @package Subapp\Sql\Ast\Stmt
 */
class JoinItems extends Collection
{
    
    /**
     * TermCollection constructor.
     * @param array $expressions
     */
    public function __construct($expressions = [])
    {
        parent::__construct($expressions);
        
        $this->setClassName(Join::class);
    }
    
    /**
     * @return string
     */
    public function getRenderer()
    {
        return 'stmt.join_items';
    }
    
}