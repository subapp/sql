<?php

namespace Subapp\Sql\Ast;

/**
 * Class FieldPath
 * @package Subapp\Sql\Ast
 */
class FieldPath extends AbstractExpression
{
    
    /**
     * @var string
     */
    private $table;
    
    /**
     * @var string
     */
    private $field;
    
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
    public function getField()
    {
        return $this->field;
    }
    
    /**
     * @param string $field
     */
    public function setField($field)
    {
        $this->field = $field;
    }
    
    /**
     * @return string
     */
    public function getSqlizerName()
    {
        return 'sqlizer.field_path';
    }
    
}