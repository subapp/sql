<?php

namespace Subapp\Sql\Ast\Condition;

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
        return 'condition.like';
    }
    
}