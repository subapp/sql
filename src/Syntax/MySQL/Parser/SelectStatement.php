<?php

namespace Subapp\Sql\Syntax\MySQL\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class Select
 * @package Subapp\Sql\Syntax\MySQL\Parser\Statement
 */
class SelectStatement extends AbstractMySQLParser
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
        $select->setFrom($this->getFromParser($processor)->parse($lexer, $processor));

        if ($this->isJoin($lexer)) {
            // join...
        }

        if ($this->isWhere($lexer)) {
            $select->setCondition((new Where())->parse($lexer, $processor));
        }

        return $select;
    }
    
}