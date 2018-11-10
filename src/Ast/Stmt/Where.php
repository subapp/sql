<?php

namespace Subapp\Sql\Ast\Stmt;

use Subapp\Sql\Ast\Condition\TermCollection;

/**
 * Class Where
 * @package Subapp\Sql\Ast
 */
class Where extends AbstractExpression
{
    
    /**
     * @var TermCollection
     */
    private $collection;
    
    /**
     * @return TermCollection
     */
    public function getCollection()
    {
        return $this->collection;
    }
    
    /**
     * @param TermCollection $collection
     */
    public function setCollection(TermCollection $collection)
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