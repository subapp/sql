<?php

namespace Subapp\Sql\Ast;

use Subapp\Sql\Lexer\Lexer;

/**
 * Class Star
 * @package Subapp\Sql\Ast
 */
class Star extends Identifier
{
    
    /**
     * Star constructor.
     */
    public function __construct()
    {
        parent::__construct('*');
    }
    
}