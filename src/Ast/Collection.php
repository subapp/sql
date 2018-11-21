<?php

namespace Subapp\Sql\Ast;

use Subapp\Sql\Common\ClassNameTrait;
use Subapp\Sql\Common\Collection as BaseCollection;

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
    private $isBraced = false;
    
    /**
     * @var string
     */
    private $separator = "\x20"; // space char by default

    /**
     * @return bool
     */
    public function isBraced()
    {
        return $this->isBraced;
    }

    /**
     * @param boolean $isBraced
     */
    public function setIsBraced($isBraced)
    {
        $this->isBraced = $isBraced;
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
    public function getRenderer()
    {
        return 'converter.collection';
    }

    /**
     * @inheritDoc
     */
    public function getNodeName()
    {
        return $this->getUnderscore(static::class);
    }

}