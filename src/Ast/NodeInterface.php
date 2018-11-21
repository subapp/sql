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
    public function getRenderer();

    /**
     * @return string
     */
    public function getNodeName();

}