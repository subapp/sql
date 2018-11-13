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
            
            // (t0.id + 10 / 2) * PI()
            case $this->isMathExpression($lexer):
                
                $parser = $this->getArithmeticParser($processor);
                break;
    
            // and, &&, or, ||, xor
            // like, in(), is not null, between, etc.
//            case $this->isExtraComparisonExpression($lexer):
//            case $this->isComparisonExpression($lexer):
//                $parser = $this->getConditionParser($processor);
//                break;
                
            // (select id from table0)
            case $this->isSubSelect($lexer):
                $parser = $this->getSubSelectParser($processor);
                break;
                
            // Embrace, Function, Primary
            default:
                $parser = $this->getExpressionParser($processor);
        }

        return $parser->parse($lexer, $processor);
    }
    
}