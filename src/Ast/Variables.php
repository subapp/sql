<?php

namespace Subapp\Sql\Ast;

/**
 * Class Variables
 * @package Subapp\Sql\Ast
 */
class Variables extends Collection
{
    
    /**
     * @return Collection|ExpressionInterface[]
     */
    public function getExpressions()
    {
        return $this;
    }

    /**
     * @return string
     */
    public function getSqlizerName()
    {
        return 'sqlizer.variables';
    }

}