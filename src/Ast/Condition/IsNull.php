<?php

namespace Subapp\Sql\Ast\Condition;

/**
 * Class IsNull
 * @package Subapp\Sql\Ast\Condition
 */
class IsNull extends AbstractIsNotComparison
{
    
    /**
     * @return string
     */
    public function getRendererName()
    {
        return 'condition.is_null';
    }
    
}