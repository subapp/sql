<?php

namespace Subapp\Sql\Ast;

use Subapp\Sql\Converter\ConverterInterface;

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
     * @param Identifier|NodeInterface $table
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
     * @param Identifier|NodeInterface $field
     */
    public function setField(Identifier $field)
    {
        $this->field = $field;
    }
    
    /**
     * @return string
     */
    public function getConverter()
    {
        return ConverterInterface::CONVERTER_FIELD_PATH;
    }
    
}