<?php

namespace Subapp\Sql\Ast\Stmt;

/**
 * Class Delete
 * @package Subapp\Sql\Ast\Stmt
 */
class Delete extends AbstractCommonStmt
{
    
    /**
     * @return string
     */
    public function getRendererName()
    {
        return 'stmt.delete';
    }
    
}