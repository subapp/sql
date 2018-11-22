<?php

namespace Subapp\Sql\Ast\Stmt;

use Subapp\Sql\Ast\Condition\Conditions;
use Subapp\Sql\Converter\ConverterInterface;

/**
 * Class Where
 * @package Subapp\Sql\Ast
 */
class Where extends Conditions
{
    
    /**
     * @return string
     */
    public function getRenderer()
    {
        return ConverterInterface::CONVERTER_STMT_WHERE;
    }
    
}