<?php

namespace Subapp\Sql\Ast\Statement;

use Subapp\Sql\Ast\AbstractExpression;
use Subapp\Sql\Ast;

/**
 * Class Select
 * @package Subapp\Sql\Ast\Statement
 */
class Select extends AbstractExpression
{

    /**
     * @var Ast\Variables
     */
    private $variables;

    /**
     * @var Ast\From
     */
    private $from;
    
    /**
     * @var Ast\Collection
     */
    private $joins;
    
    /**
     * @var Ast\Where
     */
    private $condition;
    
    /**
     * Select constructor.
     */
    public function __construct()
    {
        $this->variables = new Ast\Variables();
        $this->joins = new Ast\Collection();
        $this->condition = new Ast\Where();
    }
    
    /**
     * @return Ast\From
     */
    public function getFrom()
    {
        return $this->from;
    }
    
    /**
     * @param Ast\From $from
     */
    public function setFrom(Ast\From $from)
    {
        $this->from = $from;
    }

    /**
     * @param string $table
     */
    public function setPrimaryTable($table)
    {
        $this->setFrom(new Ast\From());
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
     * @param Ast\Where $condition
     */
    public function setCondition(Ast\Where $condition)
    {
        $this->condition = $condition;
    }
    
    /**
     * @return Ast\Where
     */
    public function getCondition()
    {
        return $this->condition;
    }
    
    /**
     * @return string
     */
    public function getSqlizerName()
    {
        return 'stmt.select_statement';
    }
    
}