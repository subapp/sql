<?php

namespace Subapp\Sql\Syntax\Common\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Literal as LiteralExpression;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class Literal
 * @package Subapp\Sql\Syntax\Common\Parser
 */
class Literal extends AbstractDefaultParser
{

    const MAP = [
        Lexer::T_INT => LiteralExpression::INT,
        Lexer::T_FLOAT => LiteralExpression::FLOAT,
        Lexer::T_STRING => LiteralExpression::STRING,
        Lexer::T_TRUE => LiteralExpression::BOOLEAN,
        Lexer::T_FALSE => LiteralExpression::BOOLEAN,
        Lexer::T_NULL => LiteralExpression::NULL,
    ];

    /**
     * @param LexerInterface $lexer
     * @param ProcessorInterface $processor
     * @return NodeInterface|LiteralExpression
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $allowed = array_keys(Literal::MAP);
        $token = $lexer->peek();
        $isAllowed = (in_array($token->getType(), $allowed));

        if (!$isAllowed) {
            $this->throwSyntaxError($lexer, ...$allowed);
        }

        $this->shift($token->getType(), $lexer);
        
        return new LiteralExpression($token->getToken(), Literal::MAP[$token->getType()]);
    }

}