<?php

namespace Subapp\Sql\Ast;

use Subapp\Sql\Common\ClassNameTrait;
use Subapp\Sql\Common\Collection as BaseCollection;
use Subapp\Sql\Converter\ConverterInterface;

/**
 * Class Collection
 * @package Subapp\Sql\Ast
 */
class Collection extends BaseCollection implements NodeInterface
{
    
    use ClassNameTrait;
    
    /**
     * @var boolean
     */
    private $wrapped = false;
    
    /**
     * @var string
     */
    private $separator = "\x20"; // space char by default
    
    /**
     * @return bool
     */
    public function isWrapped()
    {
        return $this->wrapped;
    }
    
    /**
     * @param boolean $wrapped
     */
    public function setWrapped($wrapped)
    {
        $this->wrapped = $wrapped;
    }
    
    /**
     * Collection constructor.
     * @param array|NodeInterface[] $expressions
     */
    public function __construct(array $expressions = [])
    {
        parent::__construct($expressions);
        
        $this->setClass(NodeInterface::class);
    }
    
    /**
     * @return string
     */
    public function getSeparator()
    {
        return $this->separator;
    }
    
    /**
     * @param string $separator
     */
    public function setSeparator($separator)
    {
        $this->separator = $separator;
    }
    
    /**
     * @return string
     */
    public function getConverter()
    {
        return ConverterInterface::CONVERTER_COLLECTION;
    }
    
    /**
     * @inheritDoc
     */
    public function getNodeName()
    {
        return $this->getObjectName(static::class, 'ASTNode');
    }
    
}