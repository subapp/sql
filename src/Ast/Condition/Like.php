<?php

namespace Subapp\Sql\Ast\Condition;

/**
 * Class Like
 * @package Subapp\Sql\Ast\Condition
 */
class Like extends AbstractIsNotComparison
{
    
    /**
     * @return string
     */
    public function getSqlizerName()
    {
        return 'condition.like';
    }
    
}