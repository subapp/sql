<?php

namespace Subapp\Sql\Syntax\MySQL\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\Func\Ordinary;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class DefaultFunction
 * @package Subapp\Sql\Syntax\MySQL\Parser
 */
class OrdinaryFunction extends AbstractFunction
{

    /**
     * @param LexerInterface $lexer
     * @param ProcessorInterface $processor
     * @return ExpressionInterface|Ordinary
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $name = parent::parse($lexer, $processor);

        $this->match(Lexer::T_OPEN_BRACE, $lexer);

        $function = new Ordinary();
        
        $function->setFunctionName($name);
        $function->setVariables($this->getVariablesParser($processor)->parse($lexer, $processor));

        $this->match(Lexer::T_CLOSE_BRACE, $lexer);

        return $function;
    }

}