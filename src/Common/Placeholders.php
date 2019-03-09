<?php

namespace Subapp\Sql\Common;

use Subapp\Sql\Ast\Parameter;

/**
 * Class Placeholders
 * @package Subapp\Sql\Common
 */
class Placeholders extends Collection
{
    
    /**
     * @param Parameter $parameter
     */
    public function append($parameter)
    {
        parent::append($parameter->isNamed() ? $parameter->getName() : '?');
    }
    
}