<?php

namespace Subapp\Sql\Ast\Stmt;

use Subapp\Sql\Ast\Condition\Conditions;

/**
 * Class Where
 * @package Subapp\Sql\Ast
 */
class Where extends Conditions
{
    
    /**
     * @return string
     */
    public function getRendererName()
    {
        return 'stmt.where';
    }
    
}