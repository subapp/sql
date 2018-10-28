<?php

namespace Subapp\Sql\Ast;

/**
 * Class From
 * @package Subapp\Sql\Ast
 */
class From extends AbstractExpression
{
    
    /**
     * @var string
     */
    private $table;
    
    /**
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }
    
    /**
     * @param string $table
     */
    public function setTable($table)
    {
        $this->table = $table;
    }
    
    /**
     * @return string
     */
    public function getSqlizerName()
    {
        return 'sqlizer.from';
    }
    
}