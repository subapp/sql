<?php

namespace Subapp\Sql\Ast\Stmt;

use Subapp\Sql\Ast\Condition\Conditions;
use Subapp\Sql\Converter\ConverterInterface;

/**
 * Class Having
 * @package Subapp\Sql\Ast
 */
class Having extends Conditions
{
    
    /**
     * @return string
     */
    public function getConverter()
    {
        return ConverterInterface::CONVERTER_STMT_HAVING;
    }
    
}