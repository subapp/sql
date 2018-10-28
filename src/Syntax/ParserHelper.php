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
     * @param ParserInterface $parser
     * @param LexerInterface  $lexer
     * @param integer         ...$tokenType
     * @throws SyntaxErrorException
     */
    public function throwSyntaxError(ParserInterface $parser, LexerInterface $lexer, ...$tokenType)
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
        
        throw new SyntaxErrorException(sprintf('Syntax error when parser "%s" work. Expected %s got "%s" at position %d',
            $this->createName(get_class($parser)), $tokenType, $token, $position));
    }
    
}