<?php

namespace Subapp\Sql\Ast;

/**
 * Class Arithmetic
 * @package Subapp\Sql\Ast
 */
class Arithmetic extends Collection
{

    /**
     * @return string
     */
    public function getRenderer()
    {
        return 'converter.arithmetic';
    }

}