<?php

namespace Subapp\Sql\Syntax\Common\Parser\Condition;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\Condition\Like;
use Subapp\Sql\Ast\Condition\Precedence;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\Common\Parser\AbstractDefaultParser;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class Comparison
 * @package Subapp\Sql\Syntax\Common\Parser\Condition
 */
class Comparison extends AbstractDefaultParser
{
    
    /**
     * @param LexerInterface     $lexer
     * @param ProcessorInterface $processor
     * @return ExpressionInterface
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $parser = $this->getExpressionParser($processor);
        $left = $parser->parse($lexer, $processor);
        $expression = null;
        
        switch (true) {
            
            // t0.id > 1 AND t0.id < 2 AND ...
            case $this->isComparisonOperator($lexer):
                $expression = new Precedence($left);
                $expression->setOperator($this->getCmpOperatorParser($processor)->parse($lexer, $processor));
                $expression->setRight($parser->parse($lexer, $processor));
                break;
    
            // t0.id [NOT] LIKE 'john%'
            case $this->isLike($lexer):
                $literal = $this->getLiteralParser($processor);
                $expression = new Like($lexer->toToken(Lexer::T_NOT));
                $expression->setLeft($left);
                $this->shift(Lexer::T_LIKE, $lexer);
                $expression->setRight($literal->parse($lexer, $processor));
                break;
                
            // t0.id [NOT] BETWEEN 10 AND 20
            case $this->isBetween($lexer):
                die("isBetween\n\n");
    
            // t0.id [NOT] IN(10, 20, 30)
            case $this->isIn($lexer):
                die("isIn\n\n");
    
            // t0.id IS [NOT] NULL
            case $this->isIsNull($lexer):
                die("isIsNull\n\n");
                
            default:
                $this->throwSyntaxError($lexer, 'Precedence', 'Like', 'IsNull', 'In', 'Between');
        }
        
        return $expression;
    }
    
}