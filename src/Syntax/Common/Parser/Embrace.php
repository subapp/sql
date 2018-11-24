<?php

namespace Subapp\Sql\Syntax\Common\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\Embrace as EmbraceExpression;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class EmbraceNode
 * @package Subapp\Sql\Syntax\Common\Parser
 */
class Embrace extends AbstractDefaultParser
{
    
    /**
     * @param LexerInterface     $lexer
     * @param ProcessorInterface $processor
     * @return NodeInterface|EmbraceExpression
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $this->shift(Lexer::T_OPEN_BRACE, $lexer);
        $expression = $this->getComplexParser($processor)->parse($lexer, $processor);
        $this->shift(Lexer::T_CLOSE_BRACE, $lexer);
        
        return new EmbraceExpression($expression);
    }
    
    /**
     * @inheritdoc
     */
    public function getName()
    {
        return self::PARSER_EMBRACE;
    }
    
}