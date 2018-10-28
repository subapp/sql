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
     * @return string
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }
    
    /**
     * @param string $identifier
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
    }
    
    /**
     * @return string
     */
    public function getSqlizerName()
    {
        return 'sqlizer.identifier';
    }
    
}