<?php

namespace Subapp\Sql\Ast;

/**
 * Class Where
 * @package Subapp\Sql\Ast
 */
class Where extends AbstractExpression
{
    
    /**
     * @var Collection
     */
    private $collection;
    
    /**
     * @return Collection
     */
    public function getCollection()
    {
        return $this->collection;
    }
    
    /**
     * @param Collection $collection
     */
    public function setCollection(Collection $collection)
    {
        $this->collection = $collection;
    }
    
    /**
     * @return string
     */
    public function getSqlizerName()
    {
        return 'stmt.where';
    }
    
}