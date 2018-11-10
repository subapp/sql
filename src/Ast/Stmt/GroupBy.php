<?php

namespace Subapp\Sql\Ast\Stmt;

use Subapp\Sql\Ast\AbstractExpression;

/**
 * Class GroupBy
 * @package Subapp\Sql\Ast
 */
class GroupBy extends AbstractExpression
{
    
    /**
     * @return string
     */
    public function getSqlizerName()
    {
        return 'stmt.group_by';
    }
    
}