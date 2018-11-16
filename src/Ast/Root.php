<?php

namespace Subapp\Sql\Ast;

use Subapp\Sql\Ast;
use Subapp\Sql\Exception\UnsupportedException;

/**
 * Class Root
 * @package Subapp\Sql\Ast
 */
class Root extends AbstractExpression
{
    
    /**
     * @var Ast\Arguments
     */
    private $arguments;
    
    /**
     * @var Ast\Stmt\From
     */
    private $from;
    
    /**
     * @var Ast\Condition\Conditions
     */
    private $joins;
    
    /**
     * @var Ast\Stmt\Where
     */
    private $where;

    /**
     * @var Ast\Stmt\Having
     */
    private $having;
    
    /**
     * @var Ast\Stmt\OrderByItems
     */
    private $orderBy;
    
    /**
     * @var Ast\Stmt\GroupBy
     */
    private $groupBy;
    
    /**
     * @var Ast\Stmt\Limit
     */
    private $limit;

    /**
     * @var boolean
     */
    private $semicolon = false;

    /**
     * Select constructor.
     */
    public function __construct()
    {
        $this->from = new Ast\Stmt\From();
        $this->arguments = new Ast\Arguments();
        $this->joins = new Ast\Collection();
        $this->where = new Ast\Stmt\Where();
        $this->groupBy = new Ast\Stmt\GroupBy();
        $this->orderBy = new Ast\Stmt\OrderByItems();
        $this->having = new Ast\Stmt\Having();
        $this->limit = new Ast\Stmt\Limit();
    }
    
    /**
     * @return Ast\Stmt\From
     */
    public function getFrom()
    {
        return $this->from;
    }
    
    /**
     * @param Ast\Stmt\From $from
     */
    public function setFrom(Ast\Stmt\From $from)
    {
        $this->from = $from;
    }
    
    /**
     * @return Ast\Arguments
     */
    public function getArguments()
    {
        return $this->arguments;
    }
    
    /**
     * @param Ast\Arguments $arguments
     */
    public function setArguments(Ast\Arguments $arguments)
    {
        $this->arguments = $arguments;
    }
    
    /**
     * @return Ast\Collection
     */
    public function getJoins()
    {
        return $this->joins;
    }
    
    /**
     * @param Ast\Collection $joins
     */
    public function setJoins(Ast\Collection $joins)
    {
        $this->joins = $joins;
    }
    
    /**
     * @param Ast\Stmt\Where $where
     */
    public function setWhere(Ast\Stmt\Where $where)
    {
        $this->where = $where;
    }
    
    /**
     * @return Ast\Stmt\Where
     */
    public function getWhere()
    {
        return $this->where;
    }

    /**
     * @return Stmt\Having
     */
    public function getHaving()
    {
        return $this->having;
    }

    /**
     * @param Stmt\Having $having
     */
    public function setHaving(Stmt\Having $having)
    {
        $this->having = $having;
    }
    
    /**
     * @return Ast\Stmt\OrderByItems
     */
    public function getOrderBy()
    {
        return $this->orderBy;
    }
    
    /**
     * @param Ast\Stmt\OrderByItems $orderByCollection
     */
    public function setOrderBy(Ast\Stmt\OrderByItems $orderByCollection)
    {
        $this->orderBy = $orderByCollection;
    }
    
    /**
     * @return Ast\Stmt\GroupBy
     */
    public function getGroupBy()
    {
        return $this->groupBy;
    }
    
    /**
     * @param Ast\Stmt\GroupBy $groupBy
     */
    public function setGroupBy(Ast\Stmt\GroupBy $groupBy)
    {
        $this->groupBy = $groupBy;
    }
    
    /**
     * @return Ast\Stmt\Limit
     */
    public function getLimit()
    {
        return $this->limit;
    }
    
    /**
     * @param Ast\Stmt\Limit $limit
     */
    public function setLimit(Ast\Stmt\Limit $limit)
    {
        $this->limit = $limit;
    }
    
    /**
     * @return Stmt\From
     */
    public function from()
    {
        return $this->getFrom();
    }
    
    /**
     * @return Arguments
     */
    public function arguments()
    {
        return $this->getArguments();
    }
    
    /**
     * @return Collection
     */
    public function joins()
    {
        return $this->getJoins();
    }
    
    /**
     * @return Stmt\Where
     */
    public function where()
    {
        return $this->getWhere();
    }

    /**
     * @return Stmt\Having
     */
    public function having()
    {
        return $this->getHaving();
    }
    
    /**
     * @return Stmt\GroupBy
     */
    public function groupBy()
    {
        return $this->getGroupBy();
    }
    
    /**
     * @return Stmt\OrderByItems
     */
    public function orderBy()
    {
        return $this->getOrderBy();
    }
    
    /**
     * @return Stmt\Limit
     */
    public function limit()
    {
        return $this->getLimit();
    }

    /**
     * @return boolean
     */
    public function isSemicolon()
    {
        return $this->semicolon;
    }

    /**
     * @param boolean $semicolon
     */
    public function setSemicolon($semicolon)
    {
        $this->semicolon = $semicolon;
    }
    
    /**
     * @throws UnsupportedException
     */
    public function getRenderer()
    {
        throw new UnsupportedException('The root AST node cannot be rendered. Its purpose is to preserve common nodes.');
    }
    
}