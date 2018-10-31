<?php

namespace Subapp\Sql\Syntax\MySQL\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class FromParser
 * @package Subapp\Sql\Syntax\MySQL\Parser\Common
 */
class From extends AbstractMySQLParser
{
    
    /**
     * @inheritdoc
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $this->shift(Lexer::T_FROM, $lexer);
        
        $parser = $this->isQuoteIdentifier($lexer)
            ? $this->getQuoteIdentifierParser($processor) : $this->getIdentifierParser($processor);

        return new Ast\From($parser->parse($lexer, $processor));
    }
    
}