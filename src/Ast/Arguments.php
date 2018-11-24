<?php

namespace Subapp\Sql\Ast;

use Subapp\Sql\Converter\ConverterInterface;

/**
 * Class Arguments
 * @package Subapp\Sql\Ast
 */
class Arguments extends Collection
{
    
    /**
     * @return string
     */
    public function getConverter()
    {
        return ConverterInterface::CONVERTER_ARGS;
    }
    
}