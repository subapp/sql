<?php

namespace Subapp\Sql\Ast\Stmt;

use Subapp\Sql\Ast\AbstractNode;
use Subapp\Sql\Ast\Literal;
use Subapp\Sql\Converter\ConverterInterface;

/**
 * Class Limit
 * @package Subapp\Sql\Ast
 */
class Limit extends AbstractNode
{
    
    /**
     * @var Literal
     */
    private $offset;
    
    /**
     * @var Literal
     */
    private $length;
    
    /**
     * Limit constructor.
     * @param Literal $offset
     * @param Literal $length
     */
    public function __construct(Literal $offset = null, Literal $length = null)
    {
        $this->offset = $offset;
        $this->length = $length;
    }
    
    /**
     * @return Literal
     */
    public function getOffset()
    {
        return $this->offset;
    }
    
    /**
     * @param Literal $offset
     */
    public function setOffset(Literal $offset)
    {
        $this->offset = $offset;
    }
    
    /**
     * @return Literal
     */
    public function getLength()
    {
        return $this->length;
    }
    
    /**
     * @param Literal $length
     */
    public function setLength(Literal $length)
    {
        $this->length = $length;
    }
    
    /**
     * @return string
     */
    public function getRenderer()
    {
        return ConverterInterface::CONVERTER_STMT_LIMIT;
    }
    
}