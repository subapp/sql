<?php

namespace Subapp\Sql\Ast\Stmt;

use Subapp\Sql\Ast\Arguments;
use Subapp\Sql\Converter\ConverterInterface;

/**
 * Class GroupBy
 * @package Subapp\Sql\Ast
 */
class GroupBy extends Arguments
{
    
    /**
     * @return string
     */
    public function getConverter()
    {
        return ConverterInterface::CONVERTER_STMT_GROUP_BY;
    }
    
}