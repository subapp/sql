<?php

namespace Subapp\Sql\Ast;

use Subapp\Sql\Converter\ConverterInterface;

/**
 * Class Identifier
 * @package Subapp\Sql\Ast
 */
class Identifier extends AbstractNode
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
     * @return string|NodeInterface
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }
    
    /**
     * @param string|NodeInterface $identifier
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
        return ConverterInterface::CONVERTER_IDENTIFIER;
    }
    
}