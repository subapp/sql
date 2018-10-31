<?php

namespace Subapp\Sql\Syntax\MySQL\Parser\Statement;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\MySQL;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class Select
 * @package Subapp\Sql\Syntax\MySQL\Parser\Statement
 */
class Select extends MySQL\Parser\AbstractMySQLParser
{
    
    /**
     * @param LexerInterface     $lexer
     * @param ProcessorInterface $processor
     * @return \Subapp\Sql\Ast\ExpressionInterface|Ast\Statement\Select
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $select = new Ast\Statement\Select();

        $expressions = $this->getArgumentsParser($processor)->parse($lexer, $processor);

        $select->setArguments($expressions);

        $select->setFrom($this->getFromParser($processor)->parse($lexer, $processor));

        return $select;
    }
    
}