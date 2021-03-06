<?php

namespace Subapp\Sql\Ast;

use Subapp\Sql\Converter\ConverterInterface;

/**
 * Class Parameter
 * @package Subapp\Sql\Ast
 */
class Parameter extends AbstractNode
{
    
    const UNNAMED = '?';
    const NAMED   = ':';
    
    /**
     * @var string
     */
    private $type = Parameter::UNNAMED;
    
    /**
     * @var null|string
     */
    private $name;
    
    /**
     * Parameter constructor.
     * @param string      $type
     * @param string|null $name
     */
    public function __construct($type = Parameter::UNNAMED, $name = null)
    {
        $this->type = $type;
        $this->name = $name;
    }
    
    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
    
    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }
    
    /**
     * @return boolean
     */
    public function isNamed()
    {
        return $this->type === Parameter::NAMED;
    }
    
    /**
     * @return boolean
     */
    public function isUnnamed()
    {
        return !$this->isNamed();
    }
    
    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
    
    /**
     * @return string
     */
    public function getConverter()
    {
        return ConverterInterface::CONVERTER_PARAMETER;
    }
    
}