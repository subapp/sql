<?php

namespace Subapp\Sql\Ast\Stmt;

use Subapp\Sql\Ast\Arguments;
use Subapp\Sql\Converter\ConverterInterface;

/**
 * Class OrderByCollection
 * @package Subapp\Sql\Ast\Stmt
 */
class OrderByItems extends Arguments
{
    
    /**
     * TermCollection constructor.
     * @param array $expressions
     */
    public function __construct($expressions = [])
    {
        parent::__construct($expressions);
        
        $this->setClass(OrderBy::class);
    }
    
    /**
     * @return string
     */
    public function getRenderer()
    {
        return ConverterInterface::CONVERTER_STMT_ORDER_BY_ITEMS;
    }
    
}