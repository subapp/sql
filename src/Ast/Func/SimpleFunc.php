<?php

namespace Subapp\Sql\Ast\Func;

use Subapp\Sql\Ast\AbstractFunction;

/**
 * Class Native
 * @package Subapp\Sql\Ast\Func
 */
class SimpleFunc extends AbstractFunction
{
    
    /**
     * @return string
     */
    public function getSqlizerName()
    {
        return 'sqlizer.simple_function';
    }
    
}