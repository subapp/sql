<?php

namespace Subapp\Sql\Ast\Stmt;

use Subapp\Sql\Ast\Arguments;
use Subapp\Sql\Ast\Variable;
use Subapp\Sql\Converter\ConverterInterface;

/**
 * Class From
 * @package Subapp\Sql\Ast
 */
class From extends Arguments
{
    
    /**
     * From constructor.
     * @param Variable ...$expressions
     */
    public function __construct(...$expressions)
    {
        $this->setClass(Variable::class);
        
        parent::__construct($expressions);
    }
    
    /**
     * @return string
     */
    public function getRenderer()
    {
        return ConverterInterface::CONVERTER_STMT_FROM;
    }
    
}