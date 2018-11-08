<?php

namespace Subapp\Sql\Syntax\Common\Parser\Condition;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\Condition\Precedence;
use Subapp\Sql\Ast\ExpressionInterface;
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
        $expressionA = $parser->parse($lexer, $processor);
        $expression = null;
        
        switch (true) {
            case $this->isComparisonOperator($lexer):
                $expression = new Precedence($expressionA);
                $expression->setOperator($this->getCmpOperatorParser($processor)->parse($lexer, $processor));
                $expression->setExpressionB($parser->parse($lexer, $processor));
                break;
            case $this->isIn($lexer):
                die("isIn\n\n");
            case $this->isIsNull($lexer):
                die("isIsNull\n\n");
            case $this->isBetween($lexer):
                die("isBetween\n\n");
            default:
                $this->throwSyntaxError($lexer, 'Comparison', 'IsNull', 'In');
        }
    
        if ($this->isLogicalOperator($lexer)) {
            $lexer->next();
            $collection = $this->getConditionParser($processor)->parse($lexer, $processor);
            $collection->prepend($expression);
            $expression = $collection;
        }
        
        return $expression;
    }
    
}