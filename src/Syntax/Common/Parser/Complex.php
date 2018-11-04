<?php

namespace Subapp\Sql\Syntax\Common\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class Complex
 * @package Subapp\Sql\Syntax\Common\Parser
 */
class Complex extends AbstractDefaultParser
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
            case $this->isSubSelect($lexer):
                $parser = $this->getSubSelectParser($processor);
                break;
            default:
                $parser = $this->getExpressionParser($processor);
        }
    
        return $parser->parse($lexer, $processor);
    }
    
}