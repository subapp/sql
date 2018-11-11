<?php

namespace Subapp\Sql\Syntax\Common\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class Primary
 * @package Subapp\Sql\Syntax\Common\Parser
 */
class Primary extends AbstractDefaultParser
{

    /**
     * @param LexerInterface $lexer
     * @param ProcessorInterface $processor
     * @return ExpressionInterface
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $parser = null;

        switch (true) {
            case $this->isFieldPath($lexer):
                $parser = $this->getFieldPathParser($processor);
                break;
            case $this->isParameter($lexer):
                $parser = $this->getParameterParser($processor);
                break;
            case $this->isIdentifier($lexer):
                $parser = $this->getIdentifierParser($processor);
                break;
            case $this->isQuoteIdentifier($lexer):
                $parser = $this->getQuoteIdentifierParser($processor);
                break;
            case $this->isLiteral($lexer):
                $parser = $this->getLiteralParser($processor);
                break;
            case $this->isMathExpression($lexer):
                $parser = $this->getArithmeticParser($processor);
                break;
            default:
                $this->throwSyntaxError($lexer, 'Identifier', 'QuoteIdentifier', 'Literal', 'FieldPath', 'MathExpression');
        }

        return $parser->parse($lexer, $processor);
    }

}