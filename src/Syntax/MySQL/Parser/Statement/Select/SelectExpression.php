<?php

namespace Subapp\Sql\Syntax\MySQL\Parser\Statement\Select;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\MySQL;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class SelectExpression
 * @package Subapp\Sql\Syntax\MySQL\Parser\Statement\Select
 */
class SelectExpression extends MySQL\Parser\AbstractMySQLParser
{
    
    /**
     * @param LexerInterface     $lexer
     * @param ProcessorInterface $processor
     * @return \Subapp\Sql\Ast\ExpressionInterface
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $identifierParser = $this->getIdentifierParser($processor);
        
        $expressions = [$identifierParser->parse($lexer, $processor)];
        
        while ($lexer->toToken(Lexer::T_COMMA)) {
            $expressions[] = $identifierParser->parse($lexer, $processor);
        }
        
        return $expressions;
    }
    
}