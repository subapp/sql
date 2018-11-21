<?php

namespace Subapp\Sql\Ast;

/**
 * Class FieldPath
 * @package Subapp\Sql\Ast
 */
class FieldPath extends AbstractNode
{
    
    /**
     * @var Identifier
     */
    private $table;
    
    /**
     * @var Identifier
     */
    private $field;
    
    /**
     * FieldPath constructor.
     * @param Identifier $table
     * @param Identifier $field
     */
    public function __construct(Identifier $table = null, Identifier $field = null)
    {
        $this->table = $table;
        $this->field = $field;
    }
    
    /**
     * @return Identifier
     */
    public function getTable()
    {
        return $this->table;
    }
    
    /**
     * @param Identifier $table
     */
    public function setTable(Identifier $table)
    {
        $this->table = $table;
    }
    
    /**
     * @return Identifier
     */
    public function getField()
    {
        return $this->field;
    }
    
    /**
     * @param Identifier $field
     */
    public function setField(Identifier $field)
    {
        $this->field = $field;
    }
    
    /**
     * @return string
     */
    public function getRenderer()
    {
        return 'represent.field_path';
    }
    
}