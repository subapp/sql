<?php

namespace Subapp\Sql\Ast\Condition;

use Subapp\Sql\Converter\ConverterInterface;

/**
 * Class IsNull
 * @package Subapp\Sql\Ast\Condition
 */
class IsNull extends AbstractIsNotPredicate
{
    
    /**
     * @return string
     */
    public function getConverter()
    {
        return ConverterInterface::CONVERTER_CONDITION_IS_NULL;
    }
    
}