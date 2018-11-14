<?php

namespace Subapp\Sql\Ast;

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