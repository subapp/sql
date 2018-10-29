<?php

namespace Subapp\Sql\Syntax\MySQL\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\Variables as VarsExpression;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\MySQL;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class Variables
 * @package Subapp\Sql\Syntax\MySQL\Parser
 */
class Variables extends MySQL\Parser\AbstractMySQLParser
{
    
    /**
     * @param LexerInterface     $lexer
     * @param ProcessorInterface $processor
     * @return ExpressionInterface|VarsExpression
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $selectExpression = new VarsExpression();
        $parser = $this->getExpressionParser($processor);

        $selectExpression->append($parser->parse($lexer, $processor));

        while ($lexer->toToken(Lexer::T_COMMA)) {
            $selectExpression->append($parser->parse($lexer, $processor));

            if ($lexer->isNext(Lexer::T_IDENTIFIER)) {
                $this->matchIf(Lexer::T_IDENTIFIER, $lexer);
            }
        }
        
        return $selectExpression;
    }
    
}