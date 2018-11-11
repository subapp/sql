<?php

namespace Subapp\Sql\Ast\Stmt;

/**
 * Class Update
 * @package Subapp\Sql\Ast\Stmt
 */
class Update extends AbstractCommonStmt
{
    
    /**
     * @return string
     */
    public function getRendererName()
    {
        return 'stmt.update';
    }
    
}