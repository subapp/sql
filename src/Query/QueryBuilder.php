<?php

namespace Subapp\Sql\Query;

use Subapp\Sql\Ast\ExpressionInterface;

/**
 * Query Builder based on AST
 *
 * Class QueryBuilder
 * @package Subapp\Sql\Query
 */
class QueryBuilder
{
    public const SELECT = 1;
    public const DELETE = 2;
    public const UPDATE = 4;
    
    public const STATE_DIRTY = 0;
    public const STATE_CLEAN = 1;
    
    /**
     * @var ExpressionInterface
     */
    private $ast;
    
    
    
    /**
     * QueryBuilder constructor.
     */
    public function __construct()
    {
    
    }
    
}