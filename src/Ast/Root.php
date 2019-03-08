<?php

namespace Subapp\Sql\Ast;

use Subapp\Sql\Ast;
use Subapp\Sql\Exception\UnsupportedException;

/**
 *
 * Root AST node is intermediate layer between StatementNode -> {RootNode} <- CommonNodes
 *
 * Class Root
 * @package Subapp\Sql\Ast
 */
class Root extends AbstractNode
{

    /**
     * @var Ast\Modifiers
     */
    private $modifiers;

    /**
     * @var Ast\Identifier
     */
    private $table;

    /**
     * @var Ast\Arguments
     */
    private $arguments;

    /**
     * @var Ast\Arguments
     */
    private $values;

    /**
     * @var Ast\Stmt\Set
     */
    private $assignment;
    
    /**
     * @var Ast\Stmt\TableReference
     */
    private $tableReference;
    
    /**
     * @var Ast\Stmt\JoinItems
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
        $this->modifiers = new Ast\Modifiers(0);
        $this->table = new Identifier();
        $this->tableReference = new Ast\Stmt\TableReference();
        $this->arguments = new Ast\Arguments();
        $this->values = new Ast\Arguments();
        $this->assignment = new Ast\Stmt\Set();
        $this->joins = new Ast\Stmt\JoinItems();
        $this->where = new Ast\Stmt\Where();
        $this->groupBy = new Ast\Stmt\GroupBy();
        $this->having = new Ast\Stmt\Having();
        $this->orderBy = new Ast\Stmt\OrderByItems();
        $this->limit = new Ast\Stmt\Limit();
    }

    /**
     * @return Modifiers
     */
    public function getModifiers()
    {
        return $this->modifiers;
    }

    /**
     * @param Modifiers $modifiers
     */
    public function setModifiers(Ast\Modifiers $modifiers)
    {
        $this->modifiers = $modifiers;
    }

    /**
     * @return Ast\Identifier
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param Ast\NodeInterface $table
     */
    public function setTable(Ast\NodeInterface $table)
    {
        $this->table = $table;
    }

    /**
     * @return Ast\Stmt\TableReference
     */
    public function getTableReference()
    {
        return $this->tableReference;
    }
    
    /**
     * @param Ast\Stmt\TableReference $tableReference
     */
    public function setTableReference(Ast\Stmt\TableReference $tableReference)
    {
        $this->tableReference = $tableReference;
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
     * @return Ast\Arguments
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * @param Ast\Arguments $values
     */
    public function setValues(Arguments $values)
    {
        $this->values = $values;
    }

    /**
     * @return Ast\Stmt\Set
     */
    public function getAssignment()
    {
        return $this->assignment;
    }

    /**
     * @param Ast\Stmt\Set $assignment
     */
    public function setAssignment(Ast\Stmt\Set $assignment)
    {
        $this->assignment = $assignment;
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
     * @return Ast\Stmt\Where
     */
    public function getWhere()
    {
        return $this->where;
    }
    
    /**
     * @param Ast\Stmt\Where $where
     */
    public function setWhere(Ast\Stmt\Where $where)
    {
        $this->where = $where;
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
     * @return Ast\Modifiers
     */
    public function modifiers()
    {
        return $this->getModifiers();
    }

    /**
     * @return Ast\Identifier
     */
    public function table()
    {
        return $this->getTable();
    }
    
    /**
     * @return Stmt\TableReference
     */
    public function tableReference()
    {
        return $this->getTableReference();
    }
    
    /**
     * @return Ast\Arguments
     */
    public function arguments()
    {
        return $this->getArguments();
    }

    /**
     * @return Ast\Arguments
     */
    public function values()
    {
        return $this->getValues();
    }

    /**
     * @return Ast\Stmt\Set
     */
    public function assignment()
    {
        return $this->getAssignment();
    }
    
    /**
     * @return Ast\Collection
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
    public function getConverter()
    {
        throw new UnsupportedException('The root AST node cannot be rendered. Its purpose is to preserve common nodes.');
    }
    
}