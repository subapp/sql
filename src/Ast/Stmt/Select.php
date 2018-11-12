<?php

namespace Subapp\Sql\Ast\Stmt;

/**
 * Class Select
 * @package Subapp\Sql\Ast\Stmt
 */
class Select extends AbstractCommonStmt
{
    
    /**
     * @return string
     */
    public function getRenderer()
    {
        return 'stmt.select';
    }
    
}