<?php

namespace Subapp\Sql\Ast\Condition;

/**
 * Class IsNull
 * @package Subapp\Sql\Ast\Condition
 */
class IsNull extends AbstractIsNotPredicate
{
    
    /**
     * @return string
     */
    public function getRenderer()
    {
        return 'condition.is_null';
    }
    
}