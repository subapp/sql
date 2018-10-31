<?php

namespace Subapp\Sql\Syntax\MySQL\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class Complex
 * @package Subapp\Sql\Syntax\MySQL\Parser
 */
class Complex extends AbstractMySQLParser
{
    
    /**
     * @param LexerInterface     $lexer
     * @param ProcessorInterface $processor
     * @return ExpressionInterface
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $parser = null;
    
        switch (true) {
            case $this->isMathExpression($lexer):
                $parser = $this->getArithmeticParser($processor);
                break;
            default:
                $parser = $this->getExpressionParser($processor);
        }
    
        return $parser->parse($lexer, $processor);
    }
    
}