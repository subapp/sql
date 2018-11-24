<?php

namespace Subapp\Sql\Syntax\Common\Parser\Condition;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\Condition\Between;
use Subapp\Sql\Ast\Condition\Cmp;
use Subapp\Sql\Ast\Condition\In;
use Subapp\Sql\Ast\Condition\IsNull;
use Subapp\Sql\Ast\Condition\Like;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\Common\Parser\AbstractDefaultParser;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class Predicate
 * @package Subapp\Sql\Syntax\Common\Parser\Condition
 */
class Predicate extends AbstractDefaultParser
{
    
    /**
     * @param LexerInterface     $lexer
     * @param ProcessorInterface $processor
     * @return NodeInterface
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        /**
         * parse left part of conditional expression
         * @example: (count(*) / 22) + 1 != 100
         */
        $parser = $this->getComplexParser($processor);
        $left = $parser->parse($lexer, $processor);

        switch (true) {
            
            // t0.id > 1 AND t0.id < 2 AND ...
            case $this->isComparisonOperator($lexer):
                $operator = $this->getCmpOperatorParser($processor);
                $cmp = new Cmp();
                
                $cmp->setLeft($left);
                $cmp->setOperator($operator->parse($lexer, $processor));
                $cmp->setRight($parser->parse($lexer, $processor));
                
                return $cmp;
            
            // t0.id [NOT] LIKE 'john%'
            case $this->isLike($lexer):
                $literal = $this->getLiteralParser($processor);
                $like = new Like($lexer->toToken(Lexer::T_NOT));
                
                $like->setLeft($left);
                $this->shift(Lexer::T_LIKE, $lexer);
                $like->setRight($literal->parse($lexer, $processor));
                
                return $like;
            
            // t0.id [NOT] BETWEEN 10 AND 20
            case $this->isBetween($lexer):
                $literal = $this->getLiteralParser($processor);
                
                $between = new Between($lexer->toToken(Lexer::T_NOT));
                
                $this->shift(Lexer::T_BETWEEN, $lexer);
                $between->setA($literal->parse($lexer, $processor));
                $this->shift(Lexer::T_AND, $lexer);
                $between->setB($literal->parse($lexer, $processor));
                
                $between->setLeft($left);
                
                return $between;
            
            // t0.id [NOT] IN(10, 20, 30)
            case $this->isIn($lexer):
                $in = new In($lexer->toToken(Lexer::T_NOT));
                $in->setLeft($left);
                
                $this->shift(Lexer::T_IN, $lexer);
                
                switch (true) {
                    case $this->isSubSelect($lexer):
                        $subSelect = $this->getSubSelectParser($processor)->parse($lexer, $processor);
                        $in->setRight($subSelect->getInner());
                        break;
                    case $lexer->peek() && $this->isLiteral($lexer):
                        $this->shift(Lexer::T_OPEN_BRACE, $lexer);
                        $in->setRight($this->getArgumentsParser($processor)->parse($lexer, $processor));
                        $this->shift(Lexer::T_CLOSE_BRACE, $lexer);
                        break;
                    default:
                        $this->throwSyntaxError($lexer, 'SubSelect', 'Arguments');
                }
                
                return $in;
            
            // t0.id IS [NOT] NULL
            case $this->isIsNull($lexer):
                $this->shift(Lexer::T_IS, $lexer);
                $isNull = new IsNull($lexer->toToken(Lexer::T_NOT));
                $this->shift(Lexer::T_NULL, $lexer);
                
                $isNull->setLeft($left);
                
                return $isNull;
            
            default:
                $this->throwSyntaxError($lexer, 'Cmp', 'Like', 'IsNull', 'In', 'Between');
        }
        
        return null;
    }
    
    /**
     * @inheritdoc
     */
    public function getName()
    {
        return self::PARSER_CONDITION_PREDICATE;
    }
    
}