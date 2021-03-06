<?php

namespace Subapp\Sql\Ast;

use Subapp\Sql\Converter\ConverterInterface;

/**
 * Class Embrace
 * @package Subapp\Sql\Ast
 */
class Embrace extends AbstractNode
{
    
    /**
     * @var NodeInterface
     */
    private $inner;
    
    /**
     * Embrace constructor.
     * @param NodeInterface $inner
     */
    public function __construct(NodeInterface $inner = null)
    {
        $this->inner = $inner;
    }
    
    /**
     * @return NodeInterface
     */
    public function getInner()
    {
        return $this->inner;
    }
    
    /**
     * @param NodeInterface $inner
     */
    public function setInner(NodeInterface $inner)
    {
        $this->inner = $inner;
    }
    
    /**
     * @return string
     */
    public function getConverter()
    {
        return ConverterInterface::CONVERTER_EMBRACE;
    }
    
}