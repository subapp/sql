<?php

namespace Subapp\Sql\Ast;

use Subapp\Sql\Common\Collection as BaseCollection;

/**
 * Class Collection
 * @package Subapp\Sql\Ast
 */
class Collection extends BaseCollection implements ExpressionInterface
{

    /**
     * @var boolean
     */
    private $isBraced = false;

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
     * @param array|ExpressionInterface[] $expressions
     */
    public function __construct(array $expressions = [])
    {
        parent::__construct($expressions);

        $this->setClass(ExpressionInterface::class);
    }
    
    /**
     * @return string
     */
    public function getRenderer()
    {
        return 'sqlizer.collection';
    }

}