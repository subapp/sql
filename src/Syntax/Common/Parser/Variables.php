<?php

namespace Subapp\Sql\Syntax\Common\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\VariableDeclaration;
use Subapp\Sql\Ast\Variables as VariablesExpression;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\Common;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class Variables
 * @package Subapp\Sql\Syntax\Common\Parser
 */
class Variables extends Common\Parser\AbstractDefaultParser
{

    /**
     * @param LexerInterface     $lexer
     * @param ProcessorInterface $processor
     * @return ExpressionInterface|VariablesExpression
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $variables = new VariablesExpression();
        $parser = $this->getComplexParser($processor);

        do {
            $expression = new VariableDeclaration($parser->parse($lexer, $processor));
    
            if ($this->isAlias($lexer)) {
                $expression->setAlias($this->getAliasParser($processor)->parse($lexer, $processor));
            }

            $variables->append($expression);
        } while ($lexer->toToken(Lexer::T_COMMA));

        return $variables;
    }

}