<?php

namespace Subapp\Sql\Syntax\Common\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Variable as VariableExpression;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class Variable
 * @package Subapp\Sql\Syntax\Common\Parser
 */
class Variable extends AbstractDefaultParser
{
    
    /**
     * @param LexerInterface     $lexer
     * @param ProcessorInterface $processor
     * @return NodeInterface
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $parser = null;
        
        switch (true) {
            case $this->isIdentifier($lexer):
                $parser = $this->getIdentifierParser($processor);
                break;
            case $this->isQuoteIdentifier($lexer):
                $parser = $this->getQuoteIdentifierParser($processor);
                break;
            case $this->isSubSelect($lexer):
                $parser = $this->getSubSelectParser($processor);
                break;
            default:
                $this->throwSyntaxError($lexer, 'Identifier', 'QuoteIdentifier', 'SubSelect');
        }
        
        $expression = new VariableExpression($parser->parse($lexer, $processor));
        
        if ($this->isAlias($lexer)) {
            $expression->setAlias($this->getAliasParser($processor)->parse($lexer, $processor));
        }
        
        return $expression;
    }
    
    /**
     * @inheritdoc
     */
    public function getName()
    {
        return self::PARSER_VARIABLE;
    }
    
}