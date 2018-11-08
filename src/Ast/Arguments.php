<?php

namespace Subapp\Sql\Ast;

/**
 * Class Arguments
 * @package Subapp\Sql\Ast
 */
class Arguments extends Variables
{

    /**
     * @return string
     */
    public function getSqlizerName()
    {
        return 'sqlizer.arguments';
    }

}