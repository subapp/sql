<?php

namespace Subapp\Sql\Query;

/**
 * Query Builder (Facade) based on AST
 *  - use Recognizer for parsing short-part sql
 *  - with compliance fluent interface
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
     * @var NodeBuilder
     */
    private $nb;
    
    /**
     * @var integer
     */
    private $state = QueryBuilder::STATE_CLEAN;
    
    /**
     * @var integer
     */
    private $type = QueryBuilder::SELECT;
    
    /**
     * @var Recognizer
     */
    private $recognizer;
    
    /**
     * QueryBuilder constructor.
     */
    public function __construct()
    {
        $this->nb = new NodeBuilder();
    }
    
    public function select()
    {
        $this->type = QueryBuilder::SELECT;
        
        return $this;
    }
    
    public function delete()
    {
        $this->type = QueryBuilder::DELETE;
    
        return $this;
    }
    
    public function update()
    {
        $this->type = QueryBuilder::UPDATE;
    
        return $this;
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
    
    /**
     * @return int
     */
    public function getState()
    {
        return $this->state;
    }
    
    /**
     * @param int $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }
    
    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }
    
    /**
     * @param int $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }
    
    /**
     * @return Recognizer
     */
    public function getRecognizer()
    {
        return $this->recognizer;
    }
    
    /**
     * @param Recognizer $recognizer
     */
    public function setRecognizer(Recognizer $recognizer)
    {
        $this->recognizer = $recognizer;
    }
    
}