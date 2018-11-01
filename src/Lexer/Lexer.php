<?php

namespace Subapp\Sql\Lexer;

use Subapp\Lexer\TokenInterface;

/**
 * Class SqlLexer
 * @package Subapp\Sql\Lexer
 */
class Lexer extends AbstractSqlLexer
{

    /**
     * @inheritDoc
     */
    protected function getDummyPatterns()
    {
        return ['\s+', '(.)',];
    }

    /**
     * @inheritDoc
     */
    protected function getPatterns()
    {
        return [
            '[a-z_][a-z0-9_]*[a-z0-9_]*', // identifiers
            '(?:[0-9]+(?:[\.][0-9]+)*)', // integers, floats
            '\'(?:[^\'])*\'', '"(?:[^"])*"', // quoted strings
        ];
    }

    /**
     * @inheritDoc
     */
    protected function completeToken(TokenInterface $token)
    {
        $tokenType = $this->getTokenCharacterType($token->getToken());
        $tokenValue = $token->getToken();

        if (null === $tokenType) {
            if ($tokenValue[0] === '\'' || $tokenValue[0] === '"') {
                $token->setToken(trim($tokenValue, '\'"'));
                $tokenType = static::T_STRING;
            } elseif (ctype_alpha($tokenValue[0]) || '_' === $tokenValue[0] || '\\' === $tokenValue[0]) {
                $tokenType = static::T_IDENTIFIER;
            } elseif (is_numeric($tokenValue)) {
                $tokenType = (strpos($tokenValue, '.') === false) ? static::T_INT : static::T_FLOAT;
            }
        }

        $token->setType($tokenType ?? Lexer::T_UNKNOWN);
    }

    /**
     * @inheritDoc
     */
    protected function isApplicable(TokenInterface $token)
    {
        return ($token->getType() !== Lexer::T_UNDEFINED);
    }


}