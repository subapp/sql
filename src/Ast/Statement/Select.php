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
    private $condition;
    
    /**
     * Select constructor.
     */
    public function __construct()
    {
        $this->condition = new Ast\Collection();
        $this->variables = new Ast\Variables();
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
     * @param Ast\Collection $condition
     */
    public function setCondition(Ast\Collection $condition)
    {
        $this->condition = $condition;
    }
    
    /**
     * @return Ast\Collection
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
        return 'sqlizer.select_statement';
    }
    
}