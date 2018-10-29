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
    private $expression;
    
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
        $from = new Ast\From();
        $from->setTable($table);
        $this->setFrom($from);
    }

    /**
     * @return Ast\Variables
     */
    public function getExpression()
    {
        return $this->expression;
    }

    /**
     * @param Ast\Variables $expression
     */
    public function setExpression(Ast\Variables $expression)
    {
        $this->expression = $expression;
    }
    
    /**
     * @return string
     */
    public function getSqlizerName()
    {
        return 'statement.select';
    }
    
}