<?php

namespace Subapp\Sql\Ast\Stmt;

use Subapp\Sql\Ast\Collection;
use Subapp\Sql\Converter\ConverterInterface;

/**
 * Class JoinItems
 * @package Subapp\Sql\Ast\Stmt
 */
class JoinItems extends Collection
{
    
    /**
     * TermCollection constructor.
     * @param array $expressions
     */
    public function __construct($expressions = [])
    {
        parent::__construct($expressions);
        
        $this->setClass(Join::class);
    }
    
    /**
     * @return string
     */
    public function getConverter()
    {
        return ConverterInterface::CONVERTER_STMT_JOIN_ITEMS;
    }
    
}