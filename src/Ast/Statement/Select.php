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
     * @return string
     */
    public function getSqlizerName()
    {
        return 'statement.select';
    }
    
}