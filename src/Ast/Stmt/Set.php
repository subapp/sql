<?php

namespace Subapp\Sql\Ast\Stmt;

use Subapp\Sql\Ast\Arguments;
use Subapp\Sql\Converter\ConverterInterface;

/**
 * Class Set
 * @package Subapp\Sql\Ast\Stmt
 */
class Set extends Arguments
{

    /**
     * Set constructor.
     * @param array $expressions
     */
    public function __construct($expressions = [])
    {
        parent::__construct($expressions);

        $this->setClass(Assignment::class);
    }

    /**
     * @return string
     */
    public function getConverter()
    {
        return ConverterInterface::CONVERTER_STMT_SET;
    }

}