<?php

namespace Subapp\Sql\Query;

use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Render\RendererInterface;

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
     * QueryBuilder constructor.
     */
    public function __construct()
    {
    
    }
    
    public function select()
    {
    
    }
    
    public function delete()
    {
    
    }
    
    public function update()
    {
    
    }
    
    public function and()
    {
    
    }
    
    public function or()
    {
    
    }
    
    public function xor()
    {
    
    }
    
    public function in()
    {
    
    }
    
    public function between()
    {
    
    }
    
    public function like()
    {
    
    }
    
    public function isNull()
    {
    
    }
    
}