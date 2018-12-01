<?php

namespace Subapp\Sql\Ast\Stmt;

use Subapp\Sql\Ast\Arguments;
use Subapp\Sql\Ast\Variable;
use Subapp\Sql\Converter\ConverterInterface;

/**
 * Class TableReference
 * @package Subapp\Sql\Ast
 */
class TableReference extends Arguments
{

    const SELECT_FROM = 'FROM ';

    /**
     * @var null|string
     */
    private $prefix;
    
    /**
     * From constructor.
     * @param Variable[] $expressions
     */
    public function __construct($expressions = [])
    {
        $this->setClass(Variable::class);
        
        parent::__construct($expressions);
    }

    /**
     * @return null|string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * @param null|string $prefix
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
    }
    
    /**
     * @return string
     */
    public function getConverter()
    {
        return ConverterInterface::CONVERTER_STMT_TABLE_REFERENCE;
    }
    
}