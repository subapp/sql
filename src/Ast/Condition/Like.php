<?php

namespace Subapp\Sql\Ast\Condition;

use Subapp\Sql\Converter\ConverterInterface;

/**
 * Class Like
 * @package Subapp\Sql\Ast\Condition
 */
class Like extends AbstractIsNotPredicate
{
    
    /**
     * @return string
     */
    public function getRenderer()
    {
        return ConverterInterface::CONVERTER_CONDITION_LIKE;
    }
    
}