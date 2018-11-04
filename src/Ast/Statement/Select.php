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
     * @var Ast\From
     */
    private $from;

    /**
     * @var Ast\Variables
     */
    private $variables;
    
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
     * @return string
     */
    public function getSqlizerName()
    {
        return 'sqlizer.select_statement';
    }
    
}