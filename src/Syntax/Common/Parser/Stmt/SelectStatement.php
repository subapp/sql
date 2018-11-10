<?php

namespace Subapp\Sql\Syntax\Common\Parser\Stmt;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\Common\Parser\AbstractDefaultParser;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class Select
 * @package Subapp\Sql\Syntax\MySQL\Parser\Statement
 */
class SelectStatement extends AbstractDefaultParser
{
    
    /**
     * @param LexerInterface     $lexer
     * @param ProcessorInterface $processor
     * @return \Subapp\Sql\Ast\ExpressionInterface|Ast\Statement\Select
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $this->shiftIf(Lexer::T_SELECT, $lexer);

        $select = new Ast\Statement\Select();

        $select->setVariables($this->getVariablesParser($processor)->parse($lexer, $processor));
        $select->setFrom($this->parseFromExpression($processor));

        if ($this->isJoin($lexer)) {
            $parser = $this->getJoinCollectionParser($processor);
            $select->setJoins($parser->parse($lexer, $processor));
        }

        if ($this->isWhere($lexer)) {
            $select->setCondition((new Where())->parse($lexer, $processor));
        }

        return $select;
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return Ast\ExpressionInterface|Ast\From
     */
    public function parseFromExpression(ProcessorInterface $processor)
    {
        return $processor->getParser('stmt.from')->parse($processor->getLexer(), $processor);
    }
    
}