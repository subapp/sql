<?php

namespace Subapp\Sql\Ast\Stmt;

use Subapp\Sql\Ast\Collection;
use Subapp\Sql\Converter\ConverterInterface;

/**
 * Class GroupBy
 * @package Subapp\Sql\Ast
 */
class GroupBy extends Collection
{
    
    /**
     * @return string
     */
    public function getRenderer()
    {
        return ConverterInterface::CONVERTER_STMT_GROUP_BY;
    }
    
}