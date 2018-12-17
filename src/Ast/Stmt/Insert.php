<?php

namespace Subapp\Sql\Ast\Stmt;

use Subapp\Sql\Common\Bit\AbstractBit;
use Subapp\Sql\Converter\ConverterInterface;

/**
 * Class Insert
 * @package Subapp\Sql\Ast\Stmt
 */
class Insert extends AbstractCommonStmt
{

    const INSERT_FIELDS = 2;
    const INSERT_VALUES = 4;
    const INSERT_SET_ASSIGNMENT = 8;
    const INSERT_SELECT = 16;

    /**
     * @var AbstractBit
     */
    private $type;

    /**
     * @inheritDoc
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->type = new class(0, static::class, 'INSERT') extends AbstractBit {};
    }
    
    /**
     * @return AbstractBit
     */
    public function defineType()
    {
        $valueList = $this->getValueList();
        $assignments = $this->getAssignment();
        $arguments = $this->getArguments();
        $type = $this->getType();
        
        
        if ($assignments->isNotEmpty()) {
            $type->add(self::INSERT_SET_ASSIGNMENT);
        }
        
        if ($arguments->isNotEmpty()) {
            $type->add(self::INSERT_FIELDS);
        }
        
        if ($valueList->isNotEmpty()) {
            if ($valueList->offsetExists(1)) {
                $type->add(self::INSERT_VALUES);
            } elseif ($valueList->getFirst() instanceOf Select) {
                $type->add(self::INSERT_SELECT);
            }
        }
        
        return $type;
    }
    
    public function hasType()
    {
        return $this->type->getBitMask() > 0;
    }

    /**
     * @return AbstractBit
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getConverter()
    {
        return ConverterInterface::CONVERTER_STMT_INSERT;
    }

}