<?php

namespace Subapp\Sql\Syntax\Sugar\Parser\Func;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\Condition\MatchAgainst as MatchAgainstNode;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\Common\Parser\AbstractFunction;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class MatchAgainst
 * @package Subapp\Sql\Syntax\Common\Parser\Func
 */
class MatchAgainst extends AbstractFunction
{

    /**
     * @inheritDoc
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $node = new MatchAgainstNode();
        // function name useless here
        parent::parse($lexer, $processor);

        // grab match-against extra-function expression
        $this->shift(Lexer::T_OPEN_BRACE, $lexer);
        $columns = $this->getArgumentsParser($processor)->parse($lexer, $processor);
        $this->shift(Lexer::T_AGAINST, $lexer);
        $against = $this->getLiteralParser($processor)->parse($lexer, $processor);
        $this->shift(Lexer::T_CLOSE_BRACE, $lexer);

        // complement match-against expression node
        $node->addMatchColumns($columns);

        // parse against strings
        $inner = new Lexer();
        // shift with one stub token
        $inner->tokenize($against->getValue(), true);

        // parse against strings
        $this->againstString($inner, $node);

        return $node;
    }

    /**
     * @param LexerInterface $lexer
     * @param MatchAgainstNode $node
     */
    public function againstString(LexerInterface $lexer, MatchAgainstNode $node)
    {
        while ($lexer->next()) {
            $token = $lexer->getToken();

            switch (true) {
                case $token->is(Lexer::T_PLUS):
                    $lexer->next();
                    $node->addInclusionPhrases($lexer->getTokenValue());
                    break;
                case $token->is(Lexer::T_MINUS):
                    $lexer->next();
                    $node->addExclusionPhrases($lexer->getTokenValue());
                    break;
                case $token->is(Lexer::T_TILDA):
                    $lexer->next();
                    $node->addNegationPhrases($lexer->getTokenValue());
                    break;
                case $token->is(Lexer::T_IDENTIFIER):
                    $node->addNegationPhrases($lexer->getTokenValue());
                    break;
                default:
                    $this->throwSyntaxError($lexer, Lexer::T_TILDA, Lexer::T_PLUS, Lexer::T_MINUS, Lexer::T_IDENTIFIER);
            }
        }
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return 'SUGAR_FUNC_MATCH_AGAINST';
    }

}