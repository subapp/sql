<?php

namespace Subapp\Sql\Ast\Stmt;

use Subapp\Sql\Converter\ConverterInterface;

/**
 * Class Delete
 * @package Subapp\Sql\Ast\Stmt
 */
class Delete extends AbstractCommonStmt
{
    
    /**
     * @return string
     */
    public function getRenderer()
    {
        return ConverterInterface::CONVERTER_STMT_DELETE;
    }
    
}