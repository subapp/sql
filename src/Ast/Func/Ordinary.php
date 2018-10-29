<?php

namespace Subapp\Sql\Ast\Func;

use Subapp\Sql\Ast\AbstractFunction;

/**
 * Class Native
 * @package Subapp\Sql\Ast\Func
 */
class Ordinary extends AbstractFunction
{
    
    /**
     * @return string
     */
    public function getSqlizerName()
    {
        return 'sqlizer.ordinary_function';
    }
    
}