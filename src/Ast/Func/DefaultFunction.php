<?php

namespace Subapp\Sql\Ast\Func;

/**
 * Class DefaultFunction
 * @package Subapp\Sql\Ast\Func
 */
class DefaultFunction extends AbstractFunction
{
    
    /**
     * @return string
     */
    public function getSqlizerName()
    {
        return 'func.default_function';
    }
    
}