<?php

namespace Subapp\Sql\Syntax\Common\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\Func\DefaultFunction as DefaultFunctionExpression;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Abstract Class AbstractAggregateFunction
 * @package Subapp\Sql\Syntax\Common\Parser
 */
class DefaultFunction extends AbstractFunction
{

    /**
     * @param LexerInterface $lexer
     * @param ProcessorInterface $processor
     * @return ExpressionInterface|DefaultFunctionExpression
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $function = new DefaultFunctionExpression();
        $name = parent::parse($lexer, $processor);

        $this->shift(Lexer::T_OPEN_BRACE, $lexer);
        $function->setFunctionName($name);
        $function->setArguments($this->getArgumentsParser($processor)->parse($lexer, $processor));
        $this->shift(Lexer::T_CLOSE_BRACE, $lexer);

        return $function;
    }

}