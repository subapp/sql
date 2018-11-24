<?php

namespace Subapp\Sql\Syntax;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Common\ClassNameTrait;
use Subapp\Sql\Exception\SyntaxErrorException;
use Subapp\Sql\Lexer\Lexer;

/**
 * Class ParserHelper
 * @package Subapp\Sql\Syntax
 */
final class ParserHelper
{
    
    use ClassNameTrait;
    
    /**
     * @param LexerInterface $lexer
     * @param integer        $type
     * @return string
     */
    public function getStringToToken(LexerInterface $lexer, $type)
    {
        $expression = null;
        
        $token = $lexer->getToken();
        
        do {
            $expression = sprintf('%s %s', $expression, $token->getToken());
            $token = $lexer->peek();
        } while ($token && !$token->is($type));
        
        $lexer->resetPeek();
        
        return sprintf('[.. %s ..]', $expression);
    }
    
    /**
     * @param LexerInterface $lexer
     * @param integer        $length
     * @return string
     */
    public function getStringLength(LexerInterface $lexer, $length = 5)
    {
        $expression = null;
        
        do {
            $token = $lexer->peek();
            $expression = sprintf('%s %s', $expression, $token->getToken());
        } while ($token && --$length > 0);
        
        $lexer->resetPeek();
        
        return sprintf('[.. %s ..]', $expression);
    }
    
    /**
     * @param ParserInterface $parser
     * @param LexerInterface  $lexer
     * @param integer         ...$tokenType
     * @throws SyntaxErrorException
     */
    public function throwSyntaxError(LexerInterface $lexer, $parser = null, ...$tokenType)
    {
        /** @var Lexer $lexer */
        $tokenType = array_map(function ($type) use ($lexer) {
            return is_integer($type) ? $lexer->getConstantName($type) : sprintf('"%s"', $type);
        }, $tokenType);
        
        $lastToken = array_pop($tokenType);
        $tokenType = (count($tokenType) > 0)
            ? sprintf('%s or %s', implode(', ', $tokenType), $lastToken) : $lastToken;
        
        $token = $lexer->peek();
        $position = $token ? $token->getPosition() : -1;
        $token = $token ? $token->getToken() : '[END OF LINE]';
        $parserName = $parser ? $this->getObjectName(get_class($parser)) : 'UNDEFINED';
        
        throw new SyntaxErrorException(sprintf('Syntax error. Parser [%s] expected: %s got "%s" at position %d',
            $parserName, $tokenType, $token, $position));
    }
    
}