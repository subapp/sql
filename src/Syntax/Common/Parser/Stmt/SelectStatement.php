<?php

namespace Subapp\Sql\Syntax\Common\Parser\Stmt;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\Common\Parser\AbstractDefaultParser;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class Select
 * @package Subapp\Sql\Syntax\MySQL\Parser\Stmt
 */
class SelectStatement extends AbstractDefaultParser
{
    
    /**
     * @param LexerInterface     $lexer
     * @param ProcessorInterface $processor
     * @return \Subapp\Sql\Ast\ExpressionInterface|Ast\Stmt\Select
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $this->shiftIf(Lexer::T_SELECT, $lexer);

        $select = new Ast\Stmt\Select();

        $select->setArguments($this->getVariablesParser($processor)->parse($lexer, $processor));
        $select->setFrom($this->parseFromExpression($processor));

        if ($this->isJoin($lexer)) {
            $parser = $this->getJoinCollectionParser($processor);
            $select->setJoins($parser->parse($lexer, $processor));
        }

        if ($this->isWhere($lexer)) {
            $select->setWhere($this->getWhereParser($processor)->parse($lexer, $processor));
        }
        
        if ($this->isGroupBy($lexer)) {
            $select->setGroupBy($this->getGroupByParser($processor)->parse($lexer, $processor));
        }
        
        if ($this->isOrderBy($lexer)) {
            $select->setOrderBy($this->getOrderByParser($processor)->parse($lexer, $processor));
        }
        
        if ($this->isLimit($lexer)) {
            $select->setLimit($this->getLimitParser($processor)->parse($lexer, $processor));
        }

        return $select;
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return Ast\ExpressionInterface|Ast\Stmt\From
     */
    public function parseFromExpression(ProcessorInterface $processor)
    {
        return $processor->getParser('stmt.from')->parse($processor->getLexer(), $processor);
    }
    
}