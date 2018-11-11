<?php

namespace Subapp\Sql\Ast\Stmt;

use Subapp\Sql\Ast\Arguments;
use Subapp\Sql\Ast\Variable;

/**
 * Class From
 * @package Subapp\Sql\Ast
 */
class From extends Arguments
{
    
    /**
     * From constructor.
     * @param Variable ...$expressions
     */
    public function __construct(...$expressions)
    {
        $this->setClassName(Variable::class);
        
        parent::__construct($expressions);
    }
    
    /**
     * @return string
     */
    public function getRendererName()
    {
        return 'stmt.from';
    }
    
}