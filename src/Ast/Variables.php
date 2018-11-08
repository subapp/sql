<?php

namespace Subapp\Sql\Ast;

/**
 * Class Variables
 * @package Subapp\Sql\Ast
 */
class Variables extends Collection
{

    /**
     * Variables constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data, ExpressionInterface::class);
    }

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