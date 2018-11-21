<?php

namespace Subapp\Sql\Ast;

/**
 * Class Raw
 * @package Subapp\Sql\Ast
 */
class Raw extends AbstractNode
{
    
    /**
     * @var string
     */
    private $expression;
    
    /**
     * Raw constructor.
     * @param string $expression
     */
    public function __construct($expression = null)
    {
        $this->expression = $expression;
    }
    
    /**
     * @return string
     */
    public function getExpression()
    {
        return $this->expression;
    }
    
    /**
     * @param string $expression
     */
    public function setExpression($expression)
    {
        $this->expression = $expression;
    }
    
    /**
     * @return string
     */
    public function getRenderer()
    {
        return 'converter.raw';
    }
    
}