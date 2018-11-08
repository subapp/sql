<?php

namespace Subapp\Sql\Syntax\Common\Parser\Condition;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\Collection;
use Subapp\Sql\Ast\Embrace;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\Common\Parser\AbstractDefaultParser;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class Condition
 * @package Subapp\Sql\Syntax\Common\Parser
 */
class Condition extends AbstractDefaultParser
{
    
    /**
     * @param LexerInterface     $lexer
     * @param ProcessorInterface $processor
     * @return ExpressionInterface|Collection
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $collection = new Collection();
        $comparison = $this->getComparisonParser($processor);
        $logical = $this->getLogicOperatorParser($processor);
        
        do {
            // [AND|OR|XOR] (u.id > 1)
            if ($this->isLogicalOperator($lexer)) {
                $collection->append($logical->parse($lexer, $processor));
            }
            
            // ((a > 1 AND b < 1) or (a > 2 OR b < 4))
            if ($this->isBraced($lexer)) {
                $this->shift(Lexer::T_OPEN_BRACE, $lexer);
                $expression = new Embrace($this->parse($lexer, $processor));
                $this->shift(Lexer::T_CLOSE_BRACE, $lexer);
            } else {
                $expression = $comparison->parse($lexer, $processor);
            }
            
            $collection->append($expression);
            
        } while ($this->isLogicalOperator($lexer));
        
        return $collection;
    }
    
}