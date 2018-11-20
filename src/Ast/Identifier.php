<?php

namespace Subapp\Sql\Ast;

/**
 * Class Identifier
 * @package Subapp\Sql\Ast
 */
class Identifier extends AbstractExpression
{
    
    /**
     * @var string
     */
    private $identifier;
    
    /**
     * Identifier constructor.
     * @param string $identifier
     */
    public function __construct($identifier = null)
    {
        $this->identifier = $identifier;
    }
    
    /**
     * @return string|ExpressionInterface
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }
    
    /**
     * @param string|ExpressionInterface $identifier
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
    }
    
    /**
     * @return string
     */
    public function getRenderer()
    {
        return 'represent.identifier';
    }
    
}