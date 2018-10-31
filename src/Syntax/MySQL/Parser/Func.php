<?php

namespace Subapp\Sql\Syntax\MySQL\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\Func\SimpleFunc as SimpleFunction;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class DefaultFunction
 * @package Subapp\Sql\Syntax\MySQL\Parser
 */
class Func extends AbstractFunction
{

    /**
     * @param LexerInterface $lexer
     * @param ProcessorInterface $processor
     * @return ExpressionInterface|SimpleFunction
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $name = parent::parse($lexer, $processor);

        $this->shift(Lexer::T_OPEN_BRACE, $lexer);

        $function = new SimpleFunction();
        $function->setFunctionName($name);
        $function->setArguments($this->getArgumentsParser($processor)->parse($lexer, $processor));

        $this->shift(Lexer::T_CLOSE_BRACE, $lexer);

        echo $name->getIdentifier() . PHP_EOL;

        return $function;
    }

}