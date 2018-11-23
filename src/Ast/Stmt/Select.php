<?php

namespace Subapp\Sql\Ast\Stmt;

use Subapp\Sql\Converter\ConverterInterface;

/**
 * Class Select
 * @package Subapp\Sql\Ast\Stmt
 */
class Select extends AbstractCommonStmt
{
    
    /**
     * @return string
     */
    public function getConverter()
    {
        return ConverterInterface::CONVERTER_STMT_SELECT;
    }
    
}