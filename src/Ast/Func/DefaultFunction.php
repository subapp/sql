<?php

namespace Subapp\Sql\Ast\Func;

use Subapp\Sql\Converter\ConverterInterface;

/**
 * Class DefaultFunction
 * @package Subapp\Sql\Ast\Func
 */
class DefaultFunction extends AbstractFunction
{
    
    /**
     * @return string
     */
    public function getConverter()
    {
        return ConverterInterface::CONVERTER_FUNC_DEFAULT;
    }
    
}