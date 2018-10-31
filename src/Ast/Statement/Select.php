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
     * @var Ast\Arguments
     */
    private $arguments;
    
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
     * @return string
     */
    public function getSqlizerName()
    {
        return 'statement.select';
    }
    
}