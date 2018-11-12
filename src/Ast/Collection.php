<?php

namespace Subapp\Sql\Ast;

use Subapp\Collection\Collection as BaseCollection;

/**
 * Class Collection
 * @package Subapp\Sql\Ast
 */
class Collection extends BaseCollection implements ExpressionInterface
{
    
    /**
     * Collection constructor.
     * @param array|ExpressionInterface[] $expressions
     */
    public function __construct(array $expressions = [])
    {
        parent::__construct($expressions, ExpressionInterface::class);
    }
    
    /**
     * @return string
     */
    public function getRenderer()
    {
        return 'sqlizer.collection';
    }

}