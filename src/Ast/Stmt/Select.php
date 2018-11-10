<?php

namespace Subapp\Sql\Ast\Stmt;

use Subapp\Sql\Ast\AbstractExpression;
use Subapp\Sql\Ast;

/**
 * Class Select
 * @package Subapp\Sql\Ast\Stmt
 */
class Select extends AbstractExpression
{

    /**
     * @var Ast\Variables
     */
    private $variables;

    /**
     * @var Ast\Stmt\From
     */
    private $from;
    
    /**
     * @var Ast\Condition\TermCollection
     */
    private $joins;
    
    /**
     * @var Ast\Stmt\Where
     */
    private $where;
    
    /**
     * @var Ast\Stmt\OrderByCollection
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
     * Select constructor.
     */
    public function __construct()
    {
        $this->variables = new Ast\Variables();
        $this->joins = new Ast\Collection();
        $this->where = new Ast\Stmt\Where();
        $this->orderBy = new Ast\Stmt\OrderByCollection();
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
     * @param string $table
     */
    public function setPrimaryTable($table)
    {
        $this->setFrom(new Ast\Stmt\From());
        $this->getFrom()->setExpression(new Ast\QuoteIdentifier($table));
    }

    /**
     * @return Ast\Variables
     */
    public function getVariables()
    {
        return $this->variables;
    }

    /**
     * @param Ast\Variables $variables
     */
    public function setVariables(Ast\Variables $variables)
    {
        $this->variables = $variables;
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
     * @return Ast\Stmt\OrderByCollection
     */
    public function getOrderBy()
    {
        return $this->orderBy;
    }
    
    /**
     * @param Ast\Stmt\OrderByCollection $orderByCollection
     */
    public function setOrderBy(Ast\Stmt\OrderByCollection $orderByCollection)
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
     * @return string
     */
    public function getSqlizerName()
    {
        return 'stmt.select_statement';
    }
    
}