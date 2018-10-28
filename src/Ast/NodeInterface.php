<?php

namespace Subapp\Sql\Ast;

/**
 * Interface NodeInterface
 * @package Subapp\Sql\Ast
 */
interface NodeInterface
{
    
    /**
     * @param NodeInterface $node
     */
    public function addChild(NodeInterface $node);
    
}