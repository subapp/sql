<?php

namespace Subapp\Sql\Ast;

/**
 * Class Arguments
 * @package Subapp\Sql\Ast
 */
class Arguments extends Collection
{

    /**
     * @return string
     */
    public function getRenderer()
    {
        return 'sqlizer.arguments';
    }

}