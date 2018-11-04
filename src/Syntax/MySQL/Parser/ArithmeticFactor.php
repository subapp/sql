<?php

namespace Subapp\Sql\Syntax\MySQL\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\Arithmetic as ArithmeticExpression;
use Subapp\Sql\Ast\Embrace;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class ArithmeticFactor
 * @package Subapp\Sql\Syntax\MySQL\Parser
 */
class ArithmeticFactor extends AbstractMySQLParser
{

    /**
     * @param LexerInterface $lexer
     * @param ProcessorInterface $processor
     * @return ExpressionInterface|Embrace
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $parser = $this->getOperandParser($processor);
        $arithmetic = new ArithmeticExpression();

        do {
            $arithmetic->addOperand($parser->parse($lexer, $processor));
        } while ($this->isFactorMathOperator($lexer));

        return new Embrace($arithmetic);
    }

}