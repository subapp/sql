<?php

namespace Subapp\Sql\Syntax\MySQL\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\FieldPath as FieldPathExpression;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class FieldPath
 * @package Subapp\Sql\Syntax\MySQL\Parser
 */
class FieldPath extends AbstractMySQLParser
{
    
    /**
     * @param LexerInterface     $lexer
     * @param ProcessorInterface $processor
     * @return \Subapp\Sql\Ast\ExpressionInterface|FieldPathExpression
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $identifierParser = $this->getIdentifierParser($processor);
        
        $table = $identifierParser->parse($lexer, $processor);
        $this->match(Lexer::T_DOT, $lexer);
        $field = $identifierParser->parse($lexer, $processor);
        
        $expression = new FieldPathExpression();
    
        $expression->setTable($table);
        $expression->setField($field);
        
        return $expression;
    }
    
}