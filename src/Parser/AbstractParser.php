<?php

namespace Subapp\Sql\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Exception\SyntaxErrorException;
use Subapp\Sql\Lexer\Lexer;

/**
 * Class AbstractParser
 * @package Subapp\Sql\Parser
 */
abstract class AbstractParser implements ParserInterface
{
    
    /**
     * @inheritdoc
     */
    public function isFunction(LexerInterface $lexer)
    {
        $token = $lexer->peek();
        $isFunction = ($token->is(Lexer::T_IDENTIFIER) && $lexer->peek()->is(Lexer::T_OPEN_BRACE));
        
        $lexer->resetPeek();
        
        return $isFunction;
    }
    
    /**
     * @inheritdoc
     */
    public function throwSyntaxError(LexerInterface $lexer, ...$tokenType)
    {
        /** @var Lexer $lexer */
        $tokenType = array_map(function ($type) use ($lexer) {
            return $lexer->getConstantName($type);
        }, $tokenType);
        
        $lastToken = array_pop($tokenType);
        $tokenType = (count($tokenType) > 0)
            ? sprintf('%s or %s', implode(', ', $tokenType), $lastToken) : $lastToken;
        
        $token = $lexer->peek();
        $position = $token ? $token->getPosition() : -1;
        $token = $token ? $token->getToken() : '[END OF LINE]';
        
        throw new SyntaxErrorException(sprintf('Syntax error. Expected %s got "%s" at position %d',
            $tokenType, $token, $position));
    }
    
    /**
     * @param integer        $token
     * @param LexerInterface $lexer
     */
    protected function match($token, LexerInterface $lexer)
    {
        $lexer->toToken($token) || $this->throwSyntaxError($lexer, $token);
    }
    
}