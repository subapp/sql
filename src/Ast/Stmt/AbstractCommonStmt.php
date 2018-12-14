<?php

namespace Subapp\Sql\Ast\Stmt;

use Subapp\Sql\Ast;
use Subapp\Sql\Ast\AbstractNode;

/**
 * Class AbstractCommonStmt
 * @package Subapp\Sql\Ast\Stmt
 */
abstract class AbstractCommonStmt extends AbstractNode
{
    
    /**
     * @var Ast\Root
     */
    protected $root;
    
    /**
     * AbstractCommonStmt constructor.
     */
    public function __construct()
    {
        $this->reset();
    }
    
    /**
     * @return void
     */
    public function reset()
    {
        $this->root = new Ast\Root();
    }
    
    /**
     * @return Ast\Root
     */
    public function getRoot()
    {
        return $this->root;
    }
    
    /**
     * @param Ast\Root $root
     */
    public function setRoot(Ast\Root $root)
    {
        $this->root = $root;
    }

    /**
     * @return Ast\Modifiers
     */
    public function getModifiers()
    {
        return $this->root->getModifiers();
    }

    /**
     * @param Ast\Modifiers $modifiers
     */
    public function setModifiers(Ast\Modifiers $modifiers)
    {
        $this->root->setModifiers($modifiers);
    }

    /**
     * @return Ast\Identifier
     */
    public function getTable()
    {
        return $this->root->getTable();
    }

    /**
     * @param Ast\Identifier $table
     */
    public function setTable(Ast\Identifier $table)
    {
        $this->root->setTable($table);
    }

    /**
     * @return Ast\Arguments
     */
    public function getValueList()
    {
        return $this->root->getValues();
    }

    /**
     * @param Ast\Arguments $values
     */
    public function setValueList(Ast\Arguments $values)
    {
        $this->root->setValues($values);
    }
    
    /**
     * @return Ast\Stmt\TableReference
     */
    public function getTableReference()
    {
        return $this->root->getTableReference();
    }
    
    /**
     * @param Ast\Stmt\TableReference|Ast\NodeInterface $from
     */
    public function setTableReference(Ast\Stmt\TableReference $from)
    {
        $this->root->setTableReference($from);
    }
    
    /**
     * @return Ast\Arguments
     */
    public function getArguments()
    {
        return $this->root->getArguments();
    }
    
    /**
     * @param Ast\Arguments|Ast\NodeInterface $arguments
     */
    public function setArguments(Ast\Arguments $arguments)
    {
        $this->root->setArguments($arguments);
    }

    /**
     * @return Ast\Arguments
     */
    public function getAssignment()
    {
        return $this->root->getAssignment();
    }

    /**
     * @param Ast\Arguments $assignment
     */
    public function setAssignment(Ast\Arguments $assignment)
    {
        return $this->root->setAssignment($assignment);
    }
    
    /**
     * @return Ast\Collection
     */
    public function getJoins()
    {
        return $this->root->getJoins();
    }
    
    /**
     * @param Ast\Collection|Ast\NodeInterface $joins
     */
    public function setJoins(Ast\Collection $joins)
    {
        $this->root->setJoins($joins);
    }
    
    /**
     * @param Ast\Stmt\Where|Ast\NodeInterface $where
     */
    public function setWhere(Ast\Stmt\Where $where)
    {
        $this->root->setWhere($where);
    }
    
    /**
     * @return Ast\Stmt\Where
     */
    public function getWhere()
    {
        return $this->root->getWhere();
    }
    
    /**
     * @return Ast\Stmt\OrderByItems
     */
    public function getOrderBy()
    {
        return $this->root->getOrderBy();
    }
    
    /**
     * @param Ast\Stmt\OrderByItems|Ast\NodeInterface $orderByCollection
     */
    public function setOrderBy(Ast\Stmt\OrderByItems $orderByCollection)
    {
        $this->root->setOrderBy($orderByCollection);
    }
    
    /**
     * @return Ast\Stmt\GroupBy
     */
    public function getGroupBy()
    {
        return $this->root->getGroupBy();
    }
    
    /**
     * @param Ast\Stmt\Having|Ast\NodeInterface $having
     */
    public function setHaving(Ast\Stmt\Having $having)
    {
        return $this->root->setHaving($having);
    }
    
    /**
     * @return Having
     */
    public function getHaving()
    {
        return $this->root->getHaving();
    }
    
    /**
     * @param Ast\Stmt\GroupBy|Ast\NodeInterface $groupBy
     */
    public function setGroupBy(Ast\Stmt\GroupBy $groupBy)
    {
        $this->root->setGroupBy($groupBy);
    }
    
    /**
     * @return Ast\Stmt\Limit
     */
    public function getLimit()
    {
        return $this->root->getLimit();
    }
    
    /**
     * @param Ast\Stmt\Limit|Ast\NodeInterface $limit
     */
    public function setLimit(Ast\Stmt\Limit $limit)
    {
        $this->root->setLimit($limit);
    }
    
    /**
     * @return boolean
     */
    public function isSemicolon()
    {
        return $this->root->isSemicolon();
    }
    
    /**
     * @param boolean $isSemicolon
     */
    public function setSemicolon($isSemicolon)
    {
        $this->root->setSemicolon($isSemicolon);
    }
    
}