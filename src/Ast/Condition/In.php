<?php

namespace Subapp\Sql\Ast\Condition;

use Subapp\Sql\Converter\ConverterInterface;

/**
 * Class In
 * @package Subapp\Sql\Ast\Condition
 */
class In extends AbstractIsNotPredicate
{
    
    /**
     * @return string
     */
    public function getRenderer()
    {
        return ConverterInterface::CONVERTER_CONDITION_IN;
    }
    
}