<?php

namespace Subapp\Sql\Ast;

use Subapp\Sql\Converter\ConverterInterface;

/**
 * Class Arithmetic
 * @package Subapp\Sql\Ast
 */
class Arithmetic extends Collection
{

    /**
     * @return string
     */
    public function getConverter()
    {
        return ConverterInterface::CONVERTER_ARITHMETIC;
    }

}