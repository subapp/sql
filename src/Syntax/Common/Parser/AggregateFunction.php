<?php

namespace Subapp\Sql\Syntax\Common\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\Func\AggregateFunction as AggregateFunctionExpression;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class AbstractAggregateFunction
 * @package Subapp\Sql\Syntax\Common\Parser
 */
class AggregateFunction extends AbstractFunction
{
    
    /**
     * @param LexerInterface     $lexer
     * @param ProcessorInterface $processor
     * @return NodeInterface|AggregateFunctionExpression
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $name = parent::parse($lexer, $processor);
        
        $this->shift(Lexer::T_OPEN_BRACE, $lexer);
        
        $function = new AggregateFunctionExpression($lexer->toToken(Lexer::T_DISTINCT));
        $function->setFunctionName($name);
        $function->setArguments($this->getArgumentsParser($processor)->parse($lexer, $processor));
        
        $this->shift(Lexer::T_CLOSE_BRACE, $lexer);
        
        return $function;
    }
    
    /**
     * @inheritdoc
     */
    public function getName()
    {
        return self::PARSER_AGGREGATE_FUNCTION;
    }
    
}