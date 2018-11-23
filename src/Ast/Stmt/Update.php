<?php

namespace Subapp\Sql\Ast\Stmt;

use Subapp\Sql\Converter\ConverterInterface;

/**
 * Class Update
 * @package Subapp\Sql\Ast\Stmt
 */
class Update extends AbstractCommonStmt
{
    
    /**
     * @return string
     */
    public function getConverter()
    {
        return ConverterInterface::CONVERTER_STMT_UPDATE;
    }
    
}