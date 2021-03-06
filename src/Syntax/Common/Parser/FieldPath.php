<?php

namespace Subapp\Sql\Syntax\Common\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\FieldPath as FieldPathExpression;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class FieldPath
 * @package Subapp\Sql\Syntax\Common\Parser
 */
class FieldPath extends AbstractDefaultParser
{
    
    /**
     * @param LexerInterface     $lexer
     * @param ProcessorInterface $processor
     * @return NodeInterface|FieldPathExpression
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $parser = $this->getNextParser($lexer, $processor);
        
        $table = $parser->parse($lexer, $processor);
        $this->shift(Lexer::T_DOT, $lexer);
        $field = $this->isStar($lexer)
            ? $this->getStarParser($processor)->parse($lexer, $processor)
            : $this->getNextParser($lexer, $processor)->parse($lexer, $processor);
        
        $expression = new FieldPathExpression();
        
        $expression->setTable($table);
        $expression->setField($field);
        
        return $expression;
    }

    /**
     * @param Lexer $lexer
     * @param ProcessorInterface $processor
     * @return Identifier|QuoteIdentifier
     */
    private function getNextParser(Lexer $lexer, ProcessorInterface $processor)
    {
        return $this->isQuoteIdentifier($lexer)
            ? $this->getQuoteIdentifierParser($processor) : $this->getIdentifierParser($processor);
    }
    
    /**
     * @inheritdoc
     */
    public function getName()
    {
        return self::PARSER_FIELD_PATH;
    }
    
}