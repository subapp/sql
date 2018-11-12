<?php

namespace Subapp\Sql\Ast\Condition;

/**
 * Class In
 * @package Subapp\Sql\Ast\Condition
 */
class In extends AbstractIsNotComparison
{
    
    /**
     * @return string
     */
    public function getRenderer()
    {
        return 'condition.in';
    }
    
}