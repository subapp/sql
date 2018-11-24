<?php

namespace Subapp\Sql\Syntax\Common\Parser\Stmt;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\Common\Parser\AbstractDefaultParser;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class FromParser
 * @package Subapp\Sql\Syntax\Common\Parser\Common
 */
class From extends AbstractDefaultParser
{
    
    /**
     * @inheritdoc
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $this->shift(Lexer::T_FROM, $lexer);
        
        $from = new Ast\Stmt\From();
        $parser = $this->getVariableParser($processor);
        
        do {
            $from->append($parser->parse($lexer, $processor));
        } while ($lexer->toToken(Lexer::T_COMMA));
        
        return $from;
    }
    
    /**
     * @inheritDoc
     */
    public function getName()
    {
        return self::PARSER_STMT_FROM;
    }
    
}