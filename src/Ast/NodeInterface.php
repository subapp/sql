<?php

namespace Subapp\Sql\Ast;

/**
 * Interface NodeInterface
 * @package Subapp\Sql\Ast
 */
interface NodeInterface
{
    
    /**
     * @return string
     */
    public function getConverter();
    
    /**
     * @return string
     */
    public function getNodeName();
    
}